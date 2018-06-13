<?php

namespace App\Http\Controllers\Backend;

use App\Models\AttributeValue;
use App\Models\Branch;
use App\Models\Event;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\Interfaces\ImageInterface;
use App\Services\Interfaces\ProductInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    protected $image, $productService;

    public function __construct(ImageInterface $image, ProductInterface $productService)
    {
        $this->image = $image;
        $this->productService = $productService;
    }

    public function copy($id) {
        $this->productService->copyProduct($id);
        Session::flash('success_message', 'Copy product successful');
        return redirect()->route('product.index');
    }

    public function copyAndEdit($id) {
        $product = $this->productService->copyProduct($id);
        return redirect()->route('product.edit', ['product' => $product->id]);
    }

    public function setCover(Request $request) {
        $message = '';
        $status = 500;
        $product_id = $request->product_id;
        $image = $request->image;
        if(isset($product_id) && $product_id && isset($image) && $image) {
            $product = Product::findOrFail($product_id);
            $product->cover_image = $image;
            if($product->save()) {
                $message = 'This product has been update cover image!';
                $status = 200;
            } else {
                $message = 'Fail to update cover image!';
            }
        }
        return response()->json(['message' => $message], $status);
    }

    public function addProductEvent(Request $request) {
        $product_id = $request->product_id;
        $event_id = $request->event_id;
        $event = Event::findOrFail($event_id);
        $product = Product::findOrFail($product_id);

        if($product->events->contains($event_id)) {
            $message = 'Already exist in this event';
            $status = 500;
        } else {
            $product->events()->attach([$event_id]);
            if($product->events->contains($event_id))
            {
                $message = 'Add to "'.$event->name.'" successful';
                $status = 200;
            } else {
                $message = 'Fail to add to "'.$event->name.'"';
                $status = 500;
            }
        }
        return response()->json(['message' => $message], $status);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::select('name', 'sku', 'price', 'created_at', 'branch_id', 'status', 'id', 'cover_image')->orderByDesc('id')->simplePaginate(15);
        $events = Event::active()->get();

        return view('backend.product.index', [
            'data' => $data,
            'events' => $events
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = DB::table('category')->select('id', 'name', 'slug', 'parent_id', 'status')
            ->where('type', 2)
            ->get()->toArray();

        $branch = Branch::where('status', '1')->get();
        $colors = AttributeValue::where('attribute_id', env('ATTR_COLOR'))->get();
        $sizes = AttributeValue::where('attribute_id', env('ATTR_SIZE'))->get();
        return view('backend.product.create', [
            'category' => $category,
            'branch' => $branch,
            'colors' => $colors,
            'sizes' => $sizes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|unique:products,name|max:255',
            'sku' => 'required|unique:products,sku|max:255',
            'price' => 'required|numeric|min:0',
            'new_price' => 'nullable|numeric|min:0',
            'parent' => 'required',
            'description' => 'required',
            'content' => 'required',
            'images.*' => 'image|mimes:jpeg,png|max:2048',
        ])->validate();

        $data = $request->all();
        $data['user_id'] = \Auth::user()->id;
        if(empty($request['slug'])) {
            $data['slug'] = str_slug($data['name']);
        }

        $attributes = [];
        if(isset($request->sizes) && $request->colors) {
            $attributes = array_merge($request->sizes, $request->colors);
        }

        if($product = Product::create($data)) {
            if ($request->hasFile('product_image')) {
                $files = $request->file('product_image');
                $isFirst = true;
                foreach($files as $file) {
                    $fileName = $this->image->uploads($file, 'products');
                    $input_files[] = ['image' => $fileName];
                    if($isFirst) {
                        $product->cover_image = $fileName;
                        $product->update();
                    }
                }
                $product->images()->createMany($input_files);
            }

            $product->catalogs()->attach($request->parent);

            foreach($attributes as $attr) {
                $attribute = AttributeValue::findOrFail($attr);
                $product->product_attributes()->attach([
                    $attr => ['attr_name' => $attribute->attribute->name, 'attr_value' => $attribute->attr_value]
                ]);
            }

            Session::flash('success_message', 'Your product has been created');
        } else {
            Session::flash('error_message', 'Fail to create product');
        }

        return redirect()->route('product.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = DB::table('category')->select('id', 'name', 'slug', 'parent_id', 'status')
            ->where('type', 2)
            ->get()->toArray();

        $product = Product::findOrFail($id);

        $product_catalog = [];
        foreach($product->catalogs as $i) {
            $product_catalog[] = $i->id;
        }

        $product_color = [];
        foreach($product->product_attributes_colors as $j) {
            $product_color[] = $j->id;
        }

        $product_size = [];
        foreach($product->product_attributes_sizes as $k) {
            $product_size[] = $k->id;
        }

        $product_image = [];
        foreach ($product->images as $i) {
            $product_image[] = $i->image.':'.$i->id;
        }

        $colors = AttributeValue::where('attribute_id', env('ATTR_COLOR'))->get();
        $sizes = AttributeValue::where('attribute_id', env('ATTR_SIZE'))->get();
        $branch = Branch::where('status', '1')->get();

        return view('backend.product.update', [
            'category' => $category,
            'product' => $product,
            'colors' => $colors,
            'sizes' => $sizes,
            'branch' => $branch,
            'product_catalog' => $product_catalog,
            'product_color' => $product_color,
            'product_size' => $product_size,
            'product_image' => implode('|', $product_image)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        Validator::make($request->all(), [
            'name' => 'required|unique:products,name, '.$request->segment(3).'|max:255',
            'sku' => 'required|unique:products,sku, '.$request->segment(3).'|max:255',
            'price' => 'required|numeric|min:0',
            'new_price' => 'nullable|numeric|min:0',
            'parent' => 'required',
            'description' => 'required',
            'content' => 'required',
            'images.*' => 'image|mimes:jpeg,png|max:2048',
        ])->validate();

        $data = $request->all();
        if(empty($request['slug'])) {
            $data['slug'] = str_slug($data['name']);
        }

        $sizes = empty($request->sizes) ? [] : $request->sizes;
        $colors = empty($request->colors) ? [] : $request->colors;
        $attributes = array_merge($sizes, $colors);

        if($product->update($data)) {
            if ($request->hasFile('product_image')) {
                $files = $request->file('product_image');
                foreach($files as $file) {
                    $fileName = $this->image->uploads($file, 'products');
                    $input_files[] = ['image' => $fileName];
                }
                $product->images()->createMany($input_files);
            }

            $product->catalogs()->sync($request->parent);
            $product->product_attributes()->detach();

            foreach($attributes as $attr) {
                $attribute = AttributeValue::findOrFail($attr);
                $product->product_attributes()->attach([
                    $attr => ['attr_name' => $attribute->attribute->name, 'attr_value' => $attribute->attr_value]
                ]);
            }

            Session::flash('success_message', 'Your product has been created');
        } else {
            Session::flash('error_message', 'Fail to create product');
        }
        return redirect()->route('product.index');
    }

    public function deleteImage(Request $request) {
        $id = $request->key;
        $product_image = ProductImage::findOrFail($id);
        if($product_image) {
            $this->image->deleteImage($product_image['image']);
            $product_image->delete();
            return response()->json([
                'message' => 'File has deleted!'
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->product_attributes()->detach();
        $product->tags()->detach();
        $product->catalogs()->detach();
        foreach ($product->images as $i) {
            $this->image->deleteImage($i->image);
        }
        $product->images()->delete();
        if($product->delete()) {
            Session::flash('success_message', 'Your product has been delete!');
        } else {
            Session::flash('error_message', 'Fail to delete product');
        }
        return redirect()->route('product.index');
    }
}
