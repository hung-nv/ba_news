<?php

namespace App\Http\Controllers\Backend;

use App\Models\Group;
use App\Models\Post;
use App\Models\SystemLinkType;
use App\Services\Interfaces\ImageInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    protected $image;
    private $post_type_id;

    public function __construct(ImageInterface $image)
    {
        $this->image = $image;
        $this->post_type_id = SystemLinkType::where([['name', 'like', '%news%'], ['type', 2]])->firstOrFail()->id;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::ofType($this->post_type_id)->active()->orderBy('created_at', 'desc')->get();
        $groups = Group::all();
        return view('backend.post.index', [
            'posts' => $posts,
            'groups' => $groups
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    $system_link_type = SystemLinkType::where([['name', 'like', '%news%'], ['type', 1]])->firstOrFail();
        $data = DB::table('category')->select('id', 'name', 'slug', 'parent_id', 'status')
            ->where('system_link_type_id', $system_link_type->id)
            ->get()->toArray();

        return view('backend.post.create', [
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:posts,name|max:255',
            'slug' => 'required|unique:posts,slug|max:255',
            'description' => 'required',
            'image' => 'required|image|max:10240',
            'content' => 'required',
            'parent' => 'required'
        ];

        $this->validate($request, $rules);

        $data = $request->all();
        $data['slug'] = $data['slug'] ? str_slug($data['slug']) : str_slug($data['name']);
        $data['user_id'] = \Auth::user()->id;
        $data['system_link_type_id'] = $this->post_type_id;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $this->image->uploads($file, 'posts');
            $data['image'] = $fileName;
        }

        if ($post = Post::create($data)) {
            $post->category()->attach($request->parent);
            return redirect()->route('post.index')->with(['success_message' => 'Your post has been created!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = DB::table('category')->select('id', 'name', 'slug', 'parent_id', 'status')
            ->get()->toArray();

        $post = Post::findOrFail($id);

        $post_category = [];
        foreach($post->category as $i) {
            $post_category[] = $i->id;
        }

        return view('backend.post.update', [
            'data' => $category,
            'post' => $post,
            'post_category' => $post_category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|unique:posts,name, '.$request->segment(3).'|max:255',
            'slug' => 'required|unique:posts,slug, '.$request->segment(3).'|max:255',
            'image' => 'image|max:10240',
            'description' => 'required',
            'content' => 'required',
            'parent' => 'required'
        ];

        $data = $request->all();
        $this->validate($request, $rules);
        $data['slug'] = $data['slug'] ? str_slug($data['slug']) : str_slug($data['name']);

        $post = Post::findOrFail($id);
        if ($request->hasFile('image')) {
            if(isset($request->old_image) && $request->old_image) {
                $this->image->deleteImage($request->old_image);
            }

            $file = $request->file('image');
            $fileName = $this->image->uploads($file, 'posts');
            $data['image'] = $fileName;
        }

        if ($post->update($data)) {
            $post->category()->sync($request->parent);
            return redirect()->route('post.index')->with(['success_message' => 'Your post has been updated!']);
        }

    }

    public function fileDelete(Request $request) {
        $post = Post::findOrFail($request->key);
        if($post) {
            $this->image->deleteImage($post['image']);
            $post->image = '';
            $post->save();
            return response()->json([
                'message' => 'File has deleted!'
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->category()->detach();
        if ($post->delete()) {
            $this->image->deleteImage($post->image);
            Session::flash('success_message', 'Your post has been delete!');
        } else {
            Session::flash('error_message', 'Fail to delete post');
        }
        return redirect()->route('post.index');

    }
}
