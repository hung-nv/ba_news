<?php
namespace App\Http\ViewComposers;

use App\Models\Menu;
use App\Models\Option;
use Illuminate\View\View;

class LeftMenuComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */

    public function compose(View $view)
    {
	    $meta = session('meta');
	    if(!empty($meta['left_menu_id'])) {
		    $leftMenu = Menu::group($meta['left_menu_id']);
		    $view->with('leftMenu', $leftMenu);
	    }
    }
}