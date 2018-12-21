<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\Post;
use App\Services\Interfaces\PostInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;

class HomepageController extends Controller
{
    protected $mainCategory;
    protected $hotCategory;
    protected $postServices;
    protected $detech;

    public function __construct(PostInterface $postServices, Agent $agent)
    {
        parent::__construct();
        $this->mainCategory = !empty($this->setting['parent']) ? $this->setting['parent'] : '';
        $this->hotCategory = !empty($this->setting['hot_category']) ? $this->setting['hot_category'] : '';
        $this->postServices = $postServices;
        $this->detech = $agent;
    }

    public function index(Request $request)
    {
        $newArticles = Post::ofType($this->news_details_type)
            ->select('name', 'slug', 'introduction', 'image', 'view')
            ->active()->orderByDesc('created_at')
            ->limit(11)
            ->get();
        $mainCategory = Category::find(explode(',', $this->mainCategory));

        $selectedArticles = $this->postServices->getAllPostsByCategory(
            explode(',', $this->hotCategory),
            $this->news_details_type,
            10);

        $mostArticles = Post::select('name', 'slug', 'introduction', 'image', 'created_at')->inWeek()
            ->ofType($this->news_details_type)->active()->orderDesc()->limit(5)->get();

        $layouts = 'homepage.index';
        if($this->detech->isMobile()) {
            $layouts = 'mobile.homepage.index';
        }

        return view($layouts, [
            'newArticles' => $newArticles,
            'selectedArticles' => $selectedArticles,
            'mainCategory' => $mainCategory,
            'mostArticles' => $mostArticles
        ]);
    }
}
