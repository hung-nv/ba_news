<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\SystemLinkType;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $news_details_type;
    public $news_category_type;
    public $page_type;

    public function __construct() {
		$this->getType();
    }

    public function getType()
    {
	    $this->news_details_type = SystemLinkType::where([['name', 'like', '%news%'], ['type', 2]])->first()->id;
	    $this->news_category_type = SystemLinkType::where([['name', 'like', '%news%'], ['type', 1]])->first()->id;
	    $this->page_type = SystemLinkType::where([['name', 'like', '%page%'], ['type', 2]])->first()->id;
    }
}
