<?php
namespace App\Http\ViewComposers;

use App\Models\Menu;
use Illuminate\View\View;

class TopMenuComposer
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
		if(!empty($meta['top_menu_id'])) {
			$topMenu = Menu::group($meta['top_menu_id']);
			$view->with('topMenu', $topMenu);
		}
	}
}