<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index()
    {
       // $posts=Post::all();
      $posts=auth()->user()->posts()->paginate(5);
     // dd($posts);
        return view('admin.posts.index',['posts'=>$posts]);
    }
    public function edit(Post $post)
    {

        return view('admin.posts.edit',['post'=>$post]);
    }

    public function show(Post $post)
    {

        return view('blog-post',['post'=>$post]);
    }
    public function create()
    {
        $this->authorize('create', Post::class);
        return view('admin.posts.create');
    }
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);


//dd(request()->all());
$inputs=request()->validate([
    'title'=> 'required|min:8|max:255',
    'post_image'=> 'file',
    'body'=> 'required'
]);

if(request('post_image')){
    $inputs['post_image'] = request('post_image')->store('images');
    //dd($request->post_image);
    }
    auth()->user()->posts()->create($inputs);
  Session::flash('messagecreate', $inputs['title']);
    return redirect()->route('post.index');

    //return back();
}
public function destroy(Post $post){

    $this->authorize('delete', $post);


    $post->delete();
   // session()->flash('message', 'Post was deleted');
   Session::flash('message', 'Post was deleted');


   // $request->session()->flash('message', 'Post was deleted');

    return back();
}
public function update(Post $post)
{
    $inputs=request()->validate([
        'title'=> 'required|min:8|max:255',
        'post_image'=> 'file',
        'body'=> 'required'
    ]);
   // $post=new Post();
   // $post->title=request('titie');

    if(request('post_image')){
        $inputs['post_image'] = request('post_image')->store('images');
        $post->post_image=$inputs['post_image'];

        }
        $post->title=$inputs['title'];
        $post->body=$inputs['body'];
        $this->authorize('update',$post);

     //  auth()->user()->posts()->save($post);
     $post->save();
       Session::flash('update', 'Post was update');
       return redirect()->route('post.index');



}
}
