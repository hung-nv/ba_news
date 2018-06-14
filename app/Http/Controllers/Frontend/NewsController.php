<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Production\PostService;
use App\Models\MetaField;
use App\Models\Category;

class NewsController extends Controller
{
	protected $postServices;

	public function __construct(PostService $postService) {
		parent::__construct();
		$this->postServices = $postService;
	}

    public function page($slug) {
    	$page = Post::where('slug', $slug)->first();
    	return view('news.page', [
    		'page' => $page
	    ]);
    }

	public function view($slug) {
		$article = Post::where('slug', $slug)->firstOrFail();
		$metaGame = MetaField::select( 'key_name', 'key_value' )->where( 'post_id', $article->id )->pluck( 'key_value', 'key_name' );
		$newGames = Post::ofType($this->news_details_type)->select('name', 'slug', 'introduction', 'image')->active()->orderByDesc('created_at')->limit(6)->get();
		return view('news.view', [
			'article' => $article,
			'metaGame' => $metaGame,
			'newGames' => $newGames
		]);
	}

	public function category($slug) {
		$category = Category::where('slug', $slug)->first();
		$articles = $this->postServices->getAllPostsByParentCategory($category->id, [], $this->news_details_type);
		$articles = $articles->paginate(30);
		return view('news.category', [
			'category' => $category,
			'articles' => $articles
		]);
	}

	public function search(Request $request) {
		$search = $request->txtSearch;
		$articles = $this->postServices->searchPostsByName($search, $this->news_details_type);
		$articles = $articles->paginate(30);
		return view('news.search', [
			'search' => $search,
			'articles' => $articles
		]);
	}
}
