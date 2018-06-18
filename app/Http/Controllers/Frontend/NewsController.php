<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Services\Interfaces\PostInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller {
	protected $postServices;

	public function __construct( PostInterface $postService ) {
		parent::__construct();
		$this->postServices = $postService;
	}

	public function page( $slug ) {
		$page = Post::where( 'slug', $slug )->first();
		Post::where( 'slug', $slug )->update( [ 'view' => DB::raw( 'view + 1' ) ] );
		$newArticles = Post::ofType( $this->news_details_type )->select( 'name', 'slug', 'introduction', 'image', 'created_at' )->active()->orderByDesc( 'created_at' )->limit( 10 )->get();

		return view( 'news.page', [
			'page' => $page,
			'newArticles' => $newArticles
		] );
	}

	public function view( $slug ) {
		$article = Post::where( 'slug', $slug )->first();
		Post::where( 'slug', $slug )->update( [ 'view' => DB::raw( 'view + 1' ) ] );
		$newArticles = Post::ofType( $this->news_details_type )->select( 'name', 'slug', 'introduction', 'image', 'created_at' )->active()->orderByDesc( 'created_at' )->limit( 10 )->get();

		return view( 'news.view', [
			'article'     => $article,
			'newArticles' => $newArticles
		] );
	}

	public function category( $slug ) {
		$category     = Category::where( 'slug', $slug )->first();
		$articles     = $this->postServices->getAllPostsByParentCategory( $category->id, [], $this->news_details_type );
		$articles     = $articles->paginate( 10 );
		$mostArticles = Post::select( 'name', 'slug', 'introduction', 'image', 'created_at' )->inWeek()->ofType( $this->news_details_type )->active()->orderDesc()->limit( 10 )->get();

		return view( 'news.category', [
			'category'     => $category,
			'articles'     => $articles,
			'mostArticles' => $mostArticles
		] );
	}

	public function search( Request $request ) {
		$search   = $request->txtSearch;
		$articles = $this->postServices->searchPostsByName( $search, $this->news_details_type );
		$articles = $articles->paginate( 10 );

		return view( 'news.search', [
			'search'   => $search,
			'articles' => $articles
		] );
	}
}
