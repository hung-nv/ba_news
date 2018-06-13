<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Group;

class GamesComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */

    public function compose(View $view)
    {
    	$hotGroup = Group::where('value', 'like', '%hot%')->first();
	    $hotGames = $hotGroup->posts()->limit(10)->get();

        $view->with('hotGames', $hotGames);
    }
}