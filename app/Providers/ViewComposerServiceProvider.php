<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Jenssegers\Agent\Agent;

class ViewComposerServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot() {
		$this->composeSidebarBackend();
		$this->composeMenu();
		$this->composeGames();
		$this->composeBreadcumbs();
		$this->composeMeta();
		View::share('detect', new Agent());
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {
		//
	}

	private function composeSidebarBackend() {
		View::composer( 'backend.layouts.sidebar', 'App\Http\ViewComposers\SidebarComposer' );
	}

	private function composeMenu() {
		View::composer( 'layouts.header', 'App\Http\ViewComposers\TopMenuComposer' );
		View::composer( 'layouts.footer', 'App\Http\ViewComposers\FooterMenuComposer' );
		View::composer( [
			'layouts.sidebar',
			'homepage.index'
		], 'App\Http\ViewComposers\LeftMenuComposer' );
	}

	private function composeGames() {
		View::composer( 'layouts.sidebar', 'App\Http\ViewComposers\GamesComposer' );
	}

	private function composeBreadcumbs() {
		View::composer( 'layouts.breadcumbs', 'App\Http\ViewComposers\BreadcumbComposer' );
	}

	private function composeMeta() {
		View::composer( [
			'layouts.header',
			'homepage.index'
		], 'App\Http\ViewComposers\MetaComposer' );
	}
}
