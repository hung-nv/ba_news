<?php

namespace App\Providers;

use App\Services\Interfaces\ImageInterface;
use App\Services\Interfaces\MenuInterface;
use App\Services\Interfaces\PostInterface;
use App\Services\Interfaces\ProductInterface;
use App\Services\Production\ImageService;
use App\Services\Production\MenuService;
use App\Services\Production\PostService;
use App\Services\Production\ProductService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
	    Validator::extend('alpha_spaces', function ($attribute, $value, $parameters, $validator) {
		    return preg_match('/^[A-Za-z0-9_!@#$%^&*();\/|<>"\']*$/', $value);
	    });

	    Validator::extend('old_password', function ($attribute, $value, $parameters, $validator) {
		    return Hash::check($value, current($parameters));
	    });

	    Validator::replacer('old_password', function ($message, $attribute, $rule, $parameters) {
		    return 'Current Password not valid.';
	    });

//	    \App::before(function($request) {
//		    App::singleton('meta', function(){
//			    $meta = Option::select( 'key', 'value' )->pluck( 'value', 'key' );
//			    return $meta;
//		    });
//
//		    View::share('meta', app('meta'));
//	    });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
	    $this->app->bind(ProductInterface::class, ProductService::class);
	    $this->app->bind(PostInterface::class, PostService::class);
	    $this->app->bind(ImageInterface::class, ImageService::class);
	    $this->app->bind(MenuInterface::class, MenuService::class);
    }
}
