<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware( 'auth:api' )->get( '/user', function ( Request $request ) {
	return $request->user();
} );

Route::group( [ 'namespace' => 'Backend' ], function () {
	Route::post( '/set-cover-product', 'ProductController@setCover' );
	Route::post( '/add-product-event', 'ProductController@addProductEvent' );
} );

Route::group( [ 'namespace' => 'Backend\Api' ], function () {
	Route::get( '/get-post-type', [ 'as'   => 'systemLinkType.getPostType',
	                                'uses' => 'ApiSystemLinkTypeController@getPostType'
	] );
	Route::post('/posts/delete-image', ['as' => 'api.deleteImage', 'uses' => 'ApiPostController@deleteImage']);
	Route::post( '/set-post-group', 'ApiPostController@setGroup' );
	Route::post( '/remove-post-group', 'ApiPostController@removeGroup' );

	// Api menu
	Route::post('/add-category', 'ApiMenuController@addCategory');
	Route::post('/add-page', 'ApiMenuController@addPage');
	Route::post('/add-custom', 'ApiMenuController@addCustom');
	Route::post('/update-order', 'ApiMenuController@updateOrder');
	Route::post('/delete-menu', 'ApiMenuController@destroy');
	Route::get('/get-menu', 'ApiMenuController@getMenu');
	Route::get('/get_list_menu', 'ApiMenuController@getListMenu');
	Route::post('/add-menu', 'ApiMenuController@addMenu');

	// Api Category
	Route::get('/get-cate', 'ApiCategoryController@getCate')->name('api.getCate');
} );