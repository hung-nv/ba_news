<?php
/**
 * Created by PhpStorm.
 * User: hungnv
 * Date: 10/29/17
 * Time: 6:39 PM
 */

namespace App\Services\Production;

use App\Services\Interfaces\PostInterface;
use Illuminate\Support\Facades\DB;

class PostService implements PostInterface
{
	/**
	 * get all posts in category
	 *
	 * @param  int $category_id
	 * @param  array $columns
	 * @param  int $type
	 * @return object $posts
	 */

    public function getAllPostsByParentCategory($category_id, $columns = [], $type)
    {
        $ids_category = [];

        $allCategory = DB::table('category')->get();

        $this->getIdsCategoryByParent($allCategory, $category_id, null, $ids_category);

        $posts = $this->queryPosts($ids_category, $type);

        return $posts;
    }

	/**
	 * search posts by name
	 *
	 * @param  string $text
	 * @param  int $postType
	 * @return object $posts
	 */

	public function searchPostsByName($text, $postType) {
		$ids_category = [];

		$allCategory = DB::table('category')->get();

		$this->getIdsCategoryByParent($allCategory, null, null, $ids_category);

		$posts = $this->queryPosts($ids_category, $postType);

		$posts->where('name', 'like', '%'.$text.'%');

		return $posts;
	}

	/**
	 * Get all child id category of category
	 *
	 * @param  object $arrayCategory: all category
	 * @param  int $category_id
	 * @param  int $parent_id
	 * @return array $result
	 */
    public function getIdsCategoryByParent($arrayCategory, $category_id = null, $parent_id = null, &$result)
    {
        $cate_child = [];
        if (count($arrayCategory) > 0) {
            foreach ($arrayCategory as $key => $item) {
                // Nếu không phải danh mục được chỉ định thì bỏ qua phần tử này
                if (empty($parent_id) && isset($category_id) && $category_id) {
                    if ($item->id != $category_id) {
                        continue;
                    }
                }

                if (empty($parent_id)) {
                    # Nếu lấy danh mục cha theo 1 danh mục cụ thể
                    $cate_child[] = $item;
                    unset($arrayCategory[$key]);
                    continue;
                } else if ($item->parent_id == $parent_id) {
                    $cate_child[] = $item;
                    unset($arrayCategory[$key]);
                }
            }
        }

        // Lấy danh sách chuyên mục con để xử lý tiếp
        if (isset($cate_child) && $cate_child) {
            foreach ($cate_child as $item) {
                $result[] = $item->id;
                $this->getIdsCategoryByParent($arrayCategory, null, $item->id, $result);
            }
        }
    }

	/**
	 * Search all posts in category
	 *
	 * @param  array $idsParent
	 * @param  int $postType
	 * @return object $posts
	 */
    public function queryPosts($idsParent, $postType) {
	    $posts = DB::table('posts')->select('posts.name', 'posts.slug', 'posts.introduction', 'posts.description', 'posts.image', 'posts.created_at')
	               ->where('posts.status', 1)
	               ->where('posts.system_link_type_id', $postType)
	               ->join('post_category', 'posts.id', '=', 'post_category.post_id');

	    $posts->where(function ($query) use ($idsParent) {
		    foreach ($idsParent as $id) {
			    $query->orWhere('post_category.category_id', '=', $id);
		    }
	    });

	    $posts->orderByDesc('posts.created_at')->groupBy('posts.id');
	    return $posts;
    }
}