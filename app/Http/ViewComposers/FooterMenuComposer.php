<?php
namespace App\Http\ViewComposers;

use App\Models\Menu;
use Illuminate\View\View;

class FooterMenuComposer
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
		if(!empty($meta['bottom_menu_id'])) {
			$footerMenu = Menu::group($meta['bottom_menu_id']);
			$view->with('footerMenu', $footerMenu);
		}
	}
}