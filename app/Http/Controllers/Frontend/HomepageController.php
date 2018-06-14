<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\Group;
use App\Models\Option;
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
		$this->mainCategory = ! empty( session( 'meta' )['parent'] ) ? session( 'meta' )['parent'] : '';
		$this->hotCategory  = ! empty( session( 'meta' )['hot_category'] ) ? session( 'meta' )['hot_category'] : '';
		$this->postServices = $postServices;
	}

	public function index( Request $request ) {
		$newArticles  = Post::ofType( $this->news_details_type )
		                    ->select( 'name', 'slug', 'introduction', 'image', 'view' )
		                    ->active()->orderByDesc( 'created_at' )
		                    ->limit( 10 )
		                    ->get();
		$mainCategory = Category::find( explode( ',', $this->mainCategory ) );

		$hotArticles = $this->postServices->getAllPostsByCategory( explode( ',', $this->hotCategory ), $this->news_details_type );

		return view( 'homepage.index', [
			'newArticles'  => $newArticles,
			'hotArticles'  => $hotArticles,
			'mainCategory' => $mainCategory,
		] );
	}
}
