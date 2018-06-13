<?php
/**
 * Created by PhpStorm.
 * User: hungnv
 * Date: 10/29/17
 * Time: 6:32 PM
 */

namespace App\Services\Interfaces;


interface PostInterface
{
    public function getAllPostsByParentCategory($category_id, $columns = [], $type);

    public function searchPostsByName($text, $postType);

}