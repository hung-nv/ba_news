<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function page($slug) {
    	$page = Post::where('slug', $slug)->first();
    	return view('news.page', [
    		'page' => $page
	    ]);
    }
}
