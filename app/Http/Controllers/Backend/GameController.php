<?php

namespace App\Http\Controllers\Backend;

use App\Models\Group;
use App\Models\Post;
use App\Models\SystemLinkType;
use App\Services\Interfaces\ImageInterface;
use App\Services\Interfaces\MenuInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\MetaField;

class GameController extends Controller {
	protected $image, $menuService;
	private $game_type_id;

	public function __construct( ImageInterface $image, MenuInterface $menu ) {
		$this->image        = $image;
		$this->menuService  = $menu;
		$this->game_type_id = SystemLinkType::where( [
			[ 'name', 'like', '%game%' ],
			[ 'type', 2 ]
		] )->firstOrFail()->id;
	}

	public function index() {
		$games  = Post::where( 'system_link_type_id', $this->game_type_id )->active()->orderBy( 'created_at', 'desc' )->get();
		$groups = Group::all();

		return view( 'backend.game.index', [
			'games'  => $games,
			'groups' => $groups
		] );
	}

	public function create() {
		$system_link_type = SystemLinkType::where( [ [ 'name', 'like', '%game%' ], [ 'type', 1 ] ] )->firstOrFail();
		$data             = DB::table( 'category' )->select( 'id', 'name', 'slug', 'parent_id', 'status' )
		                      ->where( 'system_link_type_id', $system_link_type->id )
		                      ->get();

		return view( 'backend.game.create', [
			'data' => $data
		] );
	}

	public function store( Request $request ) {
		$rules = [
			'name'        => 'required|unique:posts,name|max:255',
			'slug'        => 'required|unique:posts,slug|max:255',
			'description' => 'required',
			'image'       => 'required|image|max:10240',
			'content'     => 'required',
			'parent'      => 'required'
		];

		$this->validate( $request, $rules );

		$data                        = $request->all();
		$data['slug']                = $data['slug'] ? str_slug( $data['slug'] ) : str_slug( $data['name'] );
		$data['user_id']             = \Auth::user()->id;
		$data['system_link_type_id'] = $this->game_type_id;
		$data['view']                = rand( 2000, 4000 );

		if ( $request->hasFile( 'image' ) ) {
			$file          = $request->file( 'image' );
			$fileName      = $this->image->uploads( $file, 'games' );
			$data['image'] = $fileName;
		}

		$objGame          = new Post;
		$dataFillable     = array_flip( $objGame->getFillable() );
		$array_meta_field = array_diff_key( $data, $dataFillable );
		unset( $array_meta_field['_token'] );

		if ( $game = Post::create( $data ) ) {
			$game->category()->attach( $request->parent );

			foreach ( $array_meta_field as $k => $v ) {
				if ( $v != '' && $v !== null && ! is_array( $v ) ) {
					$game->fields()->create( [
						'key_name'  => $k,
						'key_value' => $v
					] );
				}
			}

			return redirect()->route( 'game.index' )->with( [ 'success_message' => 'Your game has been created!' ] );
		}
	}

	public function edit( $id ) {
		$system_link_type = SystemLinkType::where( [ [ 'name', 'like', '%game%' ], [ 'type', 1 ] ] )->firstOrFail();
		$category         = DB::table( 'category' )->select( 'id', 'name', 'slug', 'parent_id', 'status' )
		                      ->where( 'system_link_type_id', $system_link_type->id )
		                      ->get()->toArray();

		$game = Post::findOrFail( $id );

		$post_category = [];
		foreach ( $game->category as $i ) {
			$post_category[] = $i->id;
		}

		$dataLanding = MetaField::select( 'key_name', 'key_value' )->where( 'post_id', $id )->pluck( 'key_value', 'key_name' );

		if ( empty( $dataLanding ) ) {
			$dataLanding = [];
		}

		return view( 'backend.game.update', [
			'data'          => $category,
			'game'          => $game,
			'post_category' => $post_category,
			'field'         => $dataLanding
		] );
	}

	public function update( Request $request, $id ) {
		$rules = [
			'name'        => 'required|unique:posts,name, ' . $request->segment( 3 ) . '|max:255',
			'slug'        => 'required|unique:posts,slug, ' . $request->segment( 3 ) . '|max:255',
			'image'       => 'image|max:10240',
			'description' => 'required',
			'content'     => 'required',
			'parent'      => 'required'
		];

		$data = $request->all();
		$this->validate( $request, $rules );
		$data['slug'] = $data['slug'] ? str_slug( $data['slug'] ) : str_slug( $data['name'] );

		$game = Post::findOrFail( $id );
		if ( $request->hasFile( 'image' ) ) {
			if ( isset( $request->old_image ) && $request->old_image ) {
				$this->image->deleteImage( $request->old_image );
			}

			$file          = $request->file( 'image' );
			$fileName      = $this->image->uploads( $file, 'posts' );
			$data['image'] = $fileName;
		}

		$objGame          = new Post;
		$dataFillable     = array_flip( $objGame->getFillable() );
		$array_meta_field = array_diff_key( $data, $dataFillable );
		unset( $array_meta_field['_token'] );

		if ( $game->update( $data ) ) {
			$game->category()->sync( $request->parent );

			foreach ( $array_meta_field as $k => $v ) {
				if ( $v !== '' && $v !== null && ! is_array( $v ) ) {
					if ( strlen( strstr( $k, 'old' ) ) > 0 || strlen( strstr( $k, '_method' ) ) > 0 ) {
						continue;
					}

					$field = MetaField::where( 'key_name', $k )->where( 'post_id', $id )->first();

					if ( $field ) {
						$field->update( [ 'key_value' => $v ] );
					} else {
						$game->fields()->create( [
							'key_name'  => $k,
							'key_value' => $v
						] );
					}
				}
			}

			return redirect()->route( 'game.index' )->with( [ 'success_message' => 'Your game has been updated!' ] );
		}

	}

	public function destroy( $id ) {
		$game = Post::findOrFail( $id );
		$game->category()->detach();
		MetaField::where( 'post_id', $id )->get()->each( function ( $field ) {
			$field->delete();
		} );
		if ( $game->delete() ) {
			$this->image->deleteImage( $game->image );
			Session::flash( 'success_message', 'Your game has been delete!' );
		} else {
			Session::flash( 'error_message', 'Fail to delete game' );
		}

		return redirect()->route( 'game.index' );

	}
}
