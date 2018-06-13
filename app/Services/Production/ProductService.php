<?php
/**
 * Created by PhpStorm.
 * User: hungnv
 * Date: 10/29/17
 * Time: 10:57 AM
 */

namespace App\Services\Production;

use App\Models\Product;
use App\Services\Interfaces\ProductInterface;
use Illuminate\Support\Facades\DB;

class ProductService implements ProductInterface
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function copyProduct($product_id)
    {
        $product = Product::findOrFail($product_id);
        $newProduct = $product->replicate();

        // check if product has number of copy
        $versionCopy = 0;
        $countCopy = Product::where('sku', 'like', '%copyof'.$product->sku.'%')->count();
        if($countCopy > 0) {
            $versionCopy = $countCopy + 1;
        }

        $newProduct->name = 'Copy of '.$product->name;
        $newProduct->slug = 'copy-of-'.$product->slug.$versionCopy;
        $newProduct->sku = 'copyof'.$product->sku.$versionCopy;
        $newProduct->push();

        foreach ($product->images as $image) {
            $fileName = $this->imageService->copyImage($image->image);
            $newProduct->images()->create([
                'image' => $fileName
            ]);
            unset($fileName);
        }

        foreach ($product->catalogs as $catalog) {
            $newProduct->catalogs()->attach($catalog);
        }

        foreach ($product->tags as $tag) {
            $newProduct->tags()->attach($tag);
        }

        foreach ($product->product_attributes as $attribute) {
            $newProduct->product_attributes()->attach([
                $attribute->id => ['attr_name' => $attribute->attribute->name, 'attr_value' => $attribute->attr_value]
            ]);
        }
        return $newProduct;
    }

    public function getMostViewProducts($limit)
    {
        return Product::orderByDesc('view')->limit($limit)->get();
    }

    public function getPopularProducts($limit)
    {
        // TODO: Implement getPopularProducts() method.
    }

    public function getRelatedProducts($product, $limit)
    {
        $idCategory = [];
        foreach($product->catalogs as $catalog) {
            $idCategory[] = $catalog->id;
        }

        $products = $this->getProductsByIdsCategory($idCategory)->limit($limit)->get();

        return $products;
    }

    public function getAllProductsByCategory($category_id, $columns = [], $post_type = 1)
    {
        $ids_category = [];

        $allCategory = DB::table('category')->get();

        $this->getIdsCategoryByParent($allCategory, $category_id, null, $ids_category);

        $products = $this->getProductsByIdsCategory($ids_category);

        return $products;
    }

    public function getIdsCategoryByParent($data, $category_id = null, $parent_id = null, &$result)
    {
        $cate_child = [];
        if (count($data) > 0) {
            foreach ($data as $key => $item) {
                // Nếu không phải danh mục được chỉ định thì bỏ qua phần tử này
                if (empty($parent_id) && isset($category_id) && $category_id) {
                    if ($item->id !== $category_id) {
                        continue;
                    }
                }

                if (empty($parent_id)) {
                    # Nếu lấy danh mục cha theo 1 danh mục cụ thể
                    $cate_child[] = $item;
                    unset($data[$key]);
                    continue;
                } else if ($item->parent_id == $parent_id) {
                    $cate_child[] = $item;
                    unset($data[$key]);
                }
            }
        }

        // Lấy danh sách chuyên mục con để xử lý tiếp
        if (isset($cate_child) && $cate_child) {
            foreach ($cate_child as $item) {
                $result[] = $item->id;
                $this->getIdsCategoryByParent($data, null, $item->id, $result);
            }
        }
    }

    public function getProductsByIdsCategory($ids_category)
    {
        $products = DB::table('products')->select('products.name', 'products.slug', 'products.description', 'products.created_at', 'products.price', 'products.new_price')
            ->where('products.status', 1)
            ->join('product_category', 'products.id', '=', 'product_category.product_id');

        $products->where(function ($query) use ($ids_category) {
            foreach ($ids_category as $id) {
                $query->orWhere('product_category.category_id', '=', $id);
            }
        });

        $products->orderByDesc('products.created_at')->groupBy('products.id');
        return $products;
    }
}