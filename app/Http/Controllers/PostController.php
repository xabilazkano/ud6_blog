<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Auth;
use Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('user_id',Auth::user()->id)->get();
        return view ('posts.index',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view ('posts.create',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     $post = new Post;
     $post->title = $request->input('title');
     $post->excerpt = $request->input('excerpt');
     $post->body = $request->input('body');
     $post->image = null;
     if (isset($request->img)) {
        $img = $request->file('img');
        $name = uniqid() . '.' . $img->getClientOriginalExtension();
        $path = Storage::disk('public')->put($name, file_get_contents($img));
        $post->image = 'img/posts/' . $name;
    }
    $post->category_id = $request->input('category');
    $post->user_id = Auth::user()->id;
    $post->save();

    $posts = Post::where('user_id',Auth::user()->id)->get();
    return view ('posts.index',['posts'=>$posts]);

}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where('id',$id)->get();
        return view('posts.show',['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        return view('posts.edit',['post' => Post::find($id),'categories' => $categories]);
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
     $post = Post::find($id);
     $post->title = $request->input('title');
     $post->excerpt = $request->input('excerpt');
     $post->body = $request->input('body');
     if (isset($request->img)) {
        $img = $request->file('img');
        $name = uniqid() . '.' . $img->getClientOriginalExtension();
        $path = Storage::disk('public')->put($name, file_get_contents($img));
        $post->image = 'img/posts/' . $name;
    }
    $post->category_id = $request->input('category');
    $post->save();

    $posts = Post::where('user_id',Auth::user()->id)->get();
    return view ('posts.index',['posts'=>$posts]);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Post::find($id)->delete();
      return back();

      $posts = Post::where('user_id',Auth::user()->id)->get();
      return view ('posts.index',['posts'=>$posts]);
  }
}
