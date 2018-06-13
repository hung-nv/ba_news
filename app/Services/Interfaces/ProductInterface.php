<?php
/**
 * Created by PhpStorm.
 * User: hungnv
 * Date: 10/29/17
 * Time: 10:45 AM
 */

namespace App\Services\Interfaces;


interface ProductInterface
{
    public function copyProduct($product_id);

    public function getPopularProducts($limit);

    public function getMostViewProducts($limit);

    public function getRelatedProducts($product, $limit);

    public function getAllProductsByCategory($category_id, $columns = [], $post_type = 1);

    public function getIdsCategoryByParent($data, $category_id = null, $parent_id = null, &$result);

    public function getProductsByIdsCategory($ids_category);
}