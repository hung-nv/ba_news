<?php

namespace App\Http\Controllers\Backend;

use App\Models\MetaField;
use App\Services\Interfaces\ImageInterface;
use App\Services\Interfaces\MenuInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    protected $image, $menuService;

    public function __construct(ImageInterface $image, MenuInterface $menuService)
    {
    	parent::__construct();
        $this->image = $image;
        $this->menuService = $menuService;
    }

    public function index() {
        $pages = Post::where('system_link_type_id', $this->page_type)->active()->orderBy('created_at', 'desc')->get();
        return view('backend.page.index', [
            'pages' => $pages
        ]);
    }

    public function create() {
        $category = DB::table('category')->select('id', 'name', 'slug', 'parent_id', 'status')
            ->get()->toArray();

        return view('backend.page.create', [
            'category' => $category
        ]);
    }

    public function store(Request $request) {
        $rules = [
            'name' => 'required|unique:posts,name|max:255',
            'slug' => 'required|unique:posts,slug|max:255',
            'image' => 'image|max:10240',
            'content' => 'required'
        ];

        $this->validate($request, $rules);

        $data = $request->all();
        $data['slug'] = $data['slug'] ? str_slug($data['slug']) : str_slug($data['name']);
        $data['user_id'] = \Auth::user()->id;
        $data['system_link_type_id'] = $this->page_type;
        $data['description'] = '';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $this->image->uploads($file, 'pages');
            $data['image'] = $fileName;
        }

        if ($post = Post::create($data)) {
            $post->category()->attach($request->parent);
            return redirect()->route('page.index')->with(['success_message' => 'Your page has been created!']);
        }
    }

    public function landing() {
        $category = DB::table('category')->select('id', 'name', 'slug', 'parent_id', 'status')
            ->get()->toArray();

        return view('backend.page.landing', [
            'category' => $category
        ]);
    }

    public function storeLanding(Request $request) {
        $rules = [
            'name' => 'required|unique:posts,name|max:255',
            'slug' => 'required|unique:posts,slug|max:255',
            'feature3-image' => 'image|max:10240',
            'feature2-image' => 'image|max:10240',
            'feature1-image' => 'image|max:10240',
        ];

        $this->validate($request, $rules);
        $data = $request->all();
        $dataPage = [
            'name' => $request->name,
            'slug' => str_slug($request->slug),
            'description' => '',
            'content' => '',
            'user_id' => Auth::user()->id,
            'status' => $request->status,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'type' => 3
        ];
        $dataPage['slug'] = $request->slug ? str_slug($request->slug) : str_slug($request->name);

        unset($data['_token']);
        unset($data['slug']);
        unset($data['parent']);
        unset($data['name']);
        unset($data['description']);
        unset($data['content']);
        unset($data['status']);
        unset($data['meta_title']);
        unset($data['meta_description']);

        if($landing = Post::create($dataPage)) {
            $landing->category()->attach($request->parent);

            foreach ($data as $k=>$v) {
                if($k != '' && $k !== null) {
                    if(strlen(strstr($k, 'image')) > 0) {
                        $file = $request->file($k);
                        $value = $this->image->uploads($file, 'fields');
                    } else {
                        $value = $v;
                    }
                    $landing->fields()->create([
                        'key_name' => $k,
                        'key_value' => $value
                    ]);
                }
            }

            return redirect()->route('page.index')->with(['success_message' => 'Your Landing has been created!']);
        }
    }

    public function edit($id) {
        $category = DB::table('category')->select('id', 'name', 'slug', 'parent_id', 'status')
            ->get()->toArray();

        $page = Post::findOrFail($id);

        $page_category = [];
        foreach($page->category as $i) {
            $page_category[] = $i->id;
        }

        return view('backend.page.update', [
            'category' => $category,
            'page' => $page,
            'page_category' => $page_category
        ]);
    }

    public function update(Request $request, $id) {
        $rules = [
            'name' => 'required|unique:posts,name, '.$request->segment(3).'|max:255',
            'slug' => 'required|unique:posts,slug, '.$request->segment(3).'|max:255',
            'image' => 'image|max:10240',
            'content' => 'required'
        ];

        $this->validate($request, $rules);

        $data = $request->all();
        $data['slug'] = $data['slug'] ? str_slug($data['slug']) : str_slug($data['name']);
        if(empty($data['description'])) {
            unset($data['description']);
        }

        $page = Post::findOrFail($id);
        if ($request->hasFile('image')) {
            if(isset($request->old_image) && $request->old_image) {
                $this->image->deleteImage($request->old_image);
            }

            $file = $request->file('image');
            $fileName = $this->image->uploads($file, 'pages');
            $data['image'] = $fileName;
        }

        $this->menuService->updatePageToMenu($page->slug, $request->name, $request->slug);

        if ($page->update($data)) {
            $page->category()->sync($request->parent);
            return redirect()->route('page.index')->with(['success_message' => 'Your page has been updated!']);
        }
    }

    public function editLanding($id) {
        $category = DB::table('category')->select('id', 'name', 'slug', 'parent_id', 'status')
            ->get()->toArray();

        $page = Post::findOrFail($id);

        $page_category = [];
        foreach($page->category as $i) {
            $page_category[] = $i->id;
        }

        $dataLanding = MetaField::select('key_name', 'key_value')->where('post_id', $id)->pluck('key_value', 'key_name');

        if(empty($dataLanding)) {
            $dataLanding = [];
        }

        return view('backend.page.updateLanding', [
            'category' => $category,
            'page' => $page,
            'page_category' => $page_category,
            'field' => $dataLanding
        ]);
    }

    public function updateLanding(Request $request, $id) {
        $rules = [
            'name' => 'required|unique:posts,name,'.$request->segment(4).'|max:255',
            'slug' => 'required|unique:posts,slug,'.$request->segment(4).'|max:255',
            'feature3-image' => 'image|max:10240',
            'feature2-image' => 'image|max:10240',
            'feature1-image' => 'image|max:10240',
        ];

        $this->validate($request, $rules);
        $data = $request->all();
        $dataPage = [
            'name' => $request->name,
            'slug' => str_slug($request->slug),
            'status' => $request->status,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ];
        $dataPage['slug'] = $request->slug ? str_slug($request->slug) : str_slug($request->name);

        unset($data['_token'], $data['slug'], $data['parent'], $data['name'], $data['status'],
            $data['meta_title'], $data['meta_description']);

        $landing = Post::findOrFail($id);

        if($landing->update($dataPage)) {
            $landing->category()->sync($request->parent);

            foreach ($data as $k=>$v) {
                if($v !== '' && $v !== null) {
                    if(strlen(strstr($k, 'old')) > 0 || strlen(strstr($k, '_method')) > 0) {
                        continue;
                    }

                    $field = MetaField::where('key_name', $k)->where('post_id', $id)->first();

                    if(strlen(strstr($k, 'image')) > 0) {
                        if ($request->hasFile($k)) {
                            $this->image->deleteImage($field['key_value']);

                            $file = $request->file($k);
                            $value = $this->image->uploads($file, 'fields');
                        }

                    } else {
                        $value = $v;
                    }

                    if($field) {
                        $field->update(['key_value' => $value]);
                    } else {
                        $landing->fields()->create([
                            'key_name' => $k,
                            'key_value' => $value
                        ]);
                    }
                }
            }

            return redirect()->route('page.index')->with(['success_message' => 'Your post has been created!']);
        }
    }

    public function destroy($id)
    {
        $page = Post::findOrFail($id);
        $page->category()->detach();
        if($page->system_link_type_id === 3) {
            MetaField::where('post_id', $id)->get()->each(function($field) {
                if(strlen(strstr($field->key_name, 'image')) > 0) {
                    $this->image->deleteImage($field->key_value);
                }
                $field->delete();
            });
        }
        if ($page->delete()) {
            $this->image->deleteImage($page->image);
            Session::flash('success_message', 'Your page has been delete!');
        } else {
            Session::flash('error_message', 'Fail to delete page');
        }
        return redirect()->route('page.index');

    }
}
