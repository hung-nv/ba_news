<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\Group;
use App\Models\Option;
use App\Models\Post;
use App\Models\SystemLinkType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;

class HomepageController extends Controller
{
	protected $game_type;
	protected $game_category_type;

	public function __construct(SystemLinkType $system_link_type) {
		$this->game_type = SystemLinkType::where([['name', 'like', '%game%'], ['type', 2]])->first()->id;
		$this->game_category_type = SystemLinkType::where([['name', 'like', '%game%'], ['type', 1]])->first()->id;
	}

	public function index(Request $request) {
		$selected_category = Option::where('key', 'parent')->first();
    	$newGames = Post::ofType($this->game_type)->select('name', 'slug', 'introduction', 'image', 'view')->active()->orderByDesc('created_at')->limit(6)->get();
    	$hotGroup = Group::where('value', 'like', '%hot%')->first();
    	if($selected_category) {
		    $gameCategory = Category::find(explode(',', $selected_category->value));
	    } else {
		    $gameCategory = Category::ofType($this->game_category_type)->active()->get();
	    }

    	$hotGames = $hotGroup->posts()->select('name', 'slug', 'introduction', 'image')->limit(4)->get();

		return view('homepage.index', [
			'newGames' => $newGames,
			'hotGames' => $hotGames,
			'gameCategory' => $gameCategory,
		]);
    }
}
