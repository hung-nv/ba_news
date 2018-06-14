<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/administrator', function () {
	return view('backend.auth.login');
});

Route::group(['prefix' => 'administrator', 'namespace' => 'Backend'], function () {
	Route::get('login', ['as' => 'login', 'uses' => 'LoginController@getLogin']);
	Route::post('login', ['as' => 'login', 'uses' => 'LoginController@postLogin']);
	Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@getLogout']);
});

Route::group(['prefix' => 'administrator', 'middleware' => 'auth', 'namespace' => 'Backend'], function () {
	Route::group(['middleware' => 'checkrole:1|2'], function () {
		Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'AdminSiteController@index']);
		Route::get('user/update-account', ['as' => 'user.updateAccount', 'uses' => 'UserController@updateAccount']);
		Route::put('user/update-account', ['as' => 'user.putUpdateAccount', 'uses' => 'UserController@account']);
		Route::resource('post', 'PostController');
		Route::resource('category', 'CategoryController');
		Route::resource('page', 'PageController', ['except' => ['show']]);
		Route::resource('game', 'GameController', ['except' => ['show']]);
		Route::resource('advertising', 'AdvertisingController', ['except' => ['show']]);
	});

	Route::group(['middleware' => 'checkrole:1'], function () {
		Route::resource('advanceField', 'AdvanceFieldController', ['except' => ['show']]);
		Route::resource('menuSystem', 'MenuSystemController', ['except' => ['show']]);
		Route::resource('user', 'UserController');
		Route::resource('setting', 'SettingController', ['only' => ['index', 'store']]);
		Route::post('setting/file-delete', ['uses' => 'SettingController@deleteFile']);
		Route::get('menu', ['as' => 'setting.menu', 'uses' => 'SettingController@menu']);
	});
});

Route::group(['namespace' => 'Frontend'], function () {
	session(['meta' => getMeta()]);
	Route::get('/', 'HomepageController@index');
	Route::get('news/{slug}', ['as' => 'news.view', 'uses' => 'NewsController@view'] );
	Route::get('page/{slug}', ['as' => 'news.page', 'uses' => 'NewsController@page']);
	Route::get('/search', ['as' => 'news.search', 'uses' => 'NewsController@search']);
	Route::get('/{slug}', ['as' => 'news.category', 'uses' => 'NewsController@category']);
});

Route::get('img/{size}/{src}', function ($size, $src) {
	$imgPath = public_path() . '/' . $src;
	$sizes = explode('_', $size);
	if(count($sizes) > 1) {
        $w = $sizes[0];
        $h = $sizes[1];
        $img = Image::cache(function ($image) use ($w, $h, $imgPath) {
            return $image->make($imgPath)->resize($w, $h);
        });
    } else {
        $img = Image::cache(function ($image) use ($size, $imgPath) {
            return $image->make($imgPath)->resize($size, null);
        });
    }
	return Response::make($img, 200, ['Content-Type' => 'image/jpeg']);
})->where('src', '[A-Za-z0-9\/\.\-\_]+');