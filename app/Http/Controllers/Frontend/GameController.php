<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\Post;
use App\Models\SystemLinkType;
use App\Services\Production\PostService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MetaField;

class GameController extends Controller
{
	protected $postServices;
	protected $game_type;

	public function __construct(PostService $postService) {
		$this->postServices = $postService;
		$this->game_type = SystemLinkType::where([['name', 'like', '%game%'], ['type', 2]])->first()->id;
	}

	public function view($slug) {
		$game = Post::where('slug', $slug)->firstOrFail();
		$metaGame = MetaField::select( 'key_name', 'key_value' )->where( 'post_id', $game->id )->pluck( 'key_value', 'key_name' );
		$newGames = Post::ofType($this->game_type)->select('name', 'slug', 'introduction', 'image')->active()->orderByDesc('created_at')->limit(6)->get();
    	return view('game.view', [
    		'game' => $game,
		    'metaGame' => $metaGame,
		    'newGames' => $newGames
	    ]);
    }

    public function category($slug) {
		$category = Category::where('slug', $slug)->first();
		$games = $this->postServices->getAllPostsByParentCategory($category->id, [], $this->game_type);
		$games = $games->paginate(30);
	    return view('game.category', [
	    	'category' => $category,
	    	'games' => $games
	    ]);
    }

    public function search(Request $request) {
		$search = $request->txtSearch;
		$games = $this->postServices->searchPostsByName($search, $this->game_type);
		$games = $games->paginate(30);
		return view('game.search', [
			'search' => $search,
			'games' => $games
		]);
    }
}
