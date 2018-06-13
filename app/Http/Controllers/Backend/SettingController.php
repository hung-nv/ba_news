<?php

namespace App\Http\Controllers\Backend;

use App\Models\Option;
use App\Models\Post;
use App\Models\SystemLinkType;
use App\Services\Interfaces\ImageInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\MenuGroup;

class SettingController extends Controller {
	protected $image;

	public function __construct( ImageInterface $image ) {
		$this->image = $image;
	}

	public function menu( Request $request ) {
		$menu_group = $request->menu_group;
		$category   = DB::table( 'category' )->select( 'id', 'name', 'slug', 'parent_id', 'status' )
		                ->get()->toArray();

		$page_type_id = SystemLinkType::where( [ [ 'name', 'like', '%page%' ], [ 'type', 2 ] ] )->firstOrFail()->id;

		$pages = Post::active()->ofType( $page_type_id )->get()->toArray();

		if ( empty( $menu_group ) ) {
			$menus = [];
		} else {
			$menus = DB::table( 'menu' )->where( 'menu_group_id', $menu_group )->orderBy( 'order' )->get()->toArray();
		}

		$menuGroups = MenuGroup::all();

		return view( 'backend.menu.index', [
			'category'   => $category,
			'pages'      => $pages,
			'menus'      => $menus,
			'menuGroups' => $menuGroups
		] );
	}

	public function deleteFile( Request $request ) {
		$keyName = $request->name;
		$option  = Option::where( 'key', $keyName )->get()->first();

		if ( $option ) {
			$this->image->deleteImage( $option->value );
			$option->value = '';
			$option->save();

			return response()->json( [
				'message' => 'File has deleted!'
			], 200 );
		}
	}

	public function index() {
		$options = Option::select( 'key', 'value' )->pluck( 'value', 'key' );

		if ( empty( $options ) ) {
			$options = [];
		}

		$pages = Post::ofType( 3 )->get();
		$menus = MenuGroup::all();

		$system_link_type = SystemLinkType::where( [ [ 'name', 'like', '%game%' ], [ 'type', 1 ] ] )->firstOrFail();
		$data             = DB::table( 'category' )->select( 'id', 'name', 'slug', 'parent_id', 'status' )
		                      ->where( 'system_link_type_id', $system_link_type->id )
		                      ->get();

		return view( 'backend.theme.setting', [
			'option' => $options,
			'pages'  => $pages,
			'menus'  => $menus,
			'data'   => $data
		] );
	}

	public function store( Request $request ) {
		$rules = [
			'company_logo' => 'image|max:10240',
			'favico'       => 'image|max:10240'
		];

		$data = $request->all();
		$this->validate( $request, $rules );
		unset( $data['_token'] );

		foreach ( $data as $k => $v ) {
			if ( strlen( strstr( $k, 'old_' ) ) > 0 ) {
				continue;
			}
			if ( $k !== null && $v !== null ) {
				if ( $request->hasFile( $k ) ) {
					$file  = $request->file( $k );
					$value = $this->image->uploads( $file, 'setting' );
				} else {
					if(is_array($v)) {
						$value = implode(',', $v);
					} else {
						$value = $v;
					}
				}
				$option = Option::where( 'key', $k );
				if ( $option->count( 'id' ) > 0 ) {
					$option = $option->get()->first();

					if ( strlen( strstr( $option->value, 'uploads/setting' ) ) ) {
						$this->image->deleteImage( $option->value );
					}

					$option->value = $value;
					$option->save();
				} else {
					Option::create( [ 'key' => $k, 'value' => $value ] );
				}
			}
		}

		return redirect()->route( 'setting.index' )->with( [ 'success_message' => 'Update successful' ] );
	}
}
