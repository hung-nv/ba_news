<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Option;

class MetaComposer
{
	/**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */

    public function compose(View $view)
    {
        $view->with('meta', session('meta'));
    }
}