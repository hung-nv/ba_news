<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\SystemLinkType;
use App\Models\Group;
use App\Models\Menu;
use Illuminate\Support\Facades\View;

class Controller extends BaseController {
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public $news_details_type;
	public $news_category_type;
	public $page_type;
	public $setting;

	public function __construct() {
		$this->getType();
		$this->getHotGroupArticles();
		$this->getSettingSite();
		$this->getMenuToShow();
	}

	public function getType() {
		$this->news_details_type  = SystemLinkType::where( [
			[ 'name', 'like', '%news%' ],
			[ 'type', 2 ]
		] )->first()->id;
		$this->news_category_type = SystemLinkType::where( [
			[ 'name', 'like', '%news%' ],
			[ 'type', 1 ]
		] )->first()->id;
		$this->page_type          = SystemLinkType::where( [
			[ 'name', 'like', '%page%' ],
			[ 'type', 2 ]
		] )->first()->id;
	}

	public function getHotGroupArticles() {
		$hotGroup    = Group::where( 'value', 'like', '%hot%' )->first();
		$hotArticles = $hotGroup->posts()->select( 'name', 'slug', 'description', 'image', 'posts.created_at' )->limit( 5 )->get();
		View::share( 'hotArticles', $hotArticles );
	}

	public function getSettingSite() {
		$this->setting = Option::select( 'key', 'value' )->pluck( 'value', 'key' );
		View::share( 'setting', $this->setting );
	}

	public function getMenuToShow()
	{
		if(!empty($this->setting['bottom_menu_id'])) {
			View::composer(['layouts.footer', 'mobile.layouts.footer'], function ($view) {
				$footerMenu = Menu::group($this->setting['bottom_menu_id']);
				$view->with('footerMenu', $footerMenu);
			});
		}

		if(!empty($this->setting['top_menu_id'])) {
			View::composer(['layouts.header', 'mobile.layouts.header'], function ($view) {
				$topMenu = Menu::group($this->setting['top_menu_id']);
				$view->with('topMenu', $topMenu);
			});
		}
	}
}
