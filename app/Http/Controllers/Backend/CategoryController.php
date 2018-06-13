<?php

namespace App\Http\Controllers\Backend;

use App\Models\SystemLinkType;
use App\Services\Interfaces\ImageInterface;
use App\Services\Interfaces\MenuInterface;
use Validator;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{

    protected $image, $menuService;

    public function __construct(ImageInterface $image, MenuInterface $menuService)
    {
        $this->image = $image;
        $this->menuService = $menuService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $category = Category::select(['id', 'name', 'slug', 'parent_id', 'status', 'system_link_type_id'])->get();

        return view('backend.category.index', [
            'category' => $category
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allCategory = DB::table('category')->select('id', 'name', 'slug', 'parent_id')
            ->get()->toArray();

        $post_type = SystemLinkType::typeOfCategory()->get();

        return view('backend.category.create', [
            'data' => $allCategory,
	        'post_type' => $post_type
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|unique:category,name|max:255',
            'image' => 'image|max:10240',
        ])->validate();

        $category = new Category;
        $category->name = $request['name'];
        $category->slug = $request['slug'] ? str_slug($request['slug']) : str_slug($request['name']);
        $category->parent_id = $request['parent_id'];
        $category->system_link_type_id = $request['type'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $this->image->uploads($file, 'category');
            $category->image = $fileName;
        }

        if ($category->save())
            return redirect()->route('category.index')->with(['success_message' => 'Your category has been created!']);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

	    $post_type = SystemLinkType::typeOfCategory()->get();

        $allCategory = DB::table('category')->select('id', 'name', 'slug', 'parent_id')
            ->get()->toArray();

        return view('backend.category.update', [
            'category' => $category,
            'data' => $allCategory,
            'post_type' => $post_type
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $oldSlug = $category->slug;
        $oldType = $category->system_link_type_id;

        Validator::make($request->all(), [
            'name' => 'required|max:255|unique:category,name,' . $request->segment(3) . '|max:255',
            'image' => 'image|max:10240',
        ])->validate();

        $category->name = $request['name'];
        $category->slug = $request['slug'] ? str_slug($request['slug']) : str_slug($request['name']);
        $category->parent_id = $request['parent_id'];
        $category->status = $request['status'];
        $category->system_link_type_id = $request['type'];

        if ($request->hasFile('image')) {
            $this->image->deleteImage($category->image);

            $file = $request->file('image');
            $fileName = $this->image->uploads($file, 'category');
            $category->image = $fileName;
        }

        if ($category->save()) {
            $this->menuService->upadteCategoryToMenu($id, $oldSlug, $oldType);
            return redirect()->route('category.index')->with(['success_message' => 'Your category has been updated!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->posts()->detach();

        if ($category->delete()) {
            $this->image->deleteImage($category->image);
            $this->menuService->deleteCategoryFromMenu($category->slug, $category->system_link_type_id);
            Session::flash('success_message', 'Your category has been delete!');
        } else {
            Session::flash('error_message', 'Fail to delete category');
        }
        return redirect()->route('category.index');
    }
}
