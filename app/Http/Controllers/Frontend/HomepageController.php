<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\Post;
use App\Services\Interfaces\PostInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomepageController extends Controller {
	protected $mainCategory;
	protected $hotCategory;
	protected $postServices;

	public function __construct( PostInterface $postServices ) {
		parent::__construct();
		$this->mainCategory = ! empty( $this->setting['parent'] ) ? $this->setting['parent'] : '';
		$this->hotCategory  = ! empty( $this->setting['hot_category'] ) ? $this->setting['hot_category'] : '';
		$this->postServices = $postServices;
	}

	public function index( Request $request ) {
		$newArticles  = Post::ofType( $this->news_details_type )
		                    ->select( 'name', 'slug', 'introduction', 'image', 'view' )
		                    ->active()->orderByDesc( 'created_at' )
		                    ->limit( 10 )
		                    ->get();
		$mainCategory = Category::find( explode( ',', $this->mainCategory ) );

		$selectedArticles = $this->postServices->getAllPostsByCategory(
			explode( ',', $this->hotCategory ),
			$this->news_details_type,
			10 );

		$mostArticles = Post::select( 'name', 'slug', 'introduction', 'image', 'created_at' )->inWeek()
		                    ->ofType( $this->news_details_type )->active()->orderDesc()->limit( 5 )->get();

		return view( 'homepage.index', [
			'newArticles'      => $newArticles,
			'selectedArticles' => $selectedArticles,
			'mainCategory'     => $mainCategory,
			'mostArticles'     => $mostArticles
		] );
	}
}
