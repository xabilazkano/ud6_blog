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
    if ($request->hasFile('img')) {
        if ($request->file('img')->isValid()){
            $img = $request->file('img')->getClientOriginalName();
            $request->file('img')->move('img/',$img);
            $post->image = $img;
        }
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
    $post = Post::find($id);
    $this->authorize('view', $post);
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
    $this->authorize('update', $post);
    return view('posts.edit',['post' => $post,'categories' => $categories]);
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
    if ($request->hasFile('img')) {
        if ($request->file('img')->isValid()){
            $img = $request->file('img')->getClientOriginalName();
            $request->file('img')->move('img/',$img);
            $post->image = $img;
        }
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
    $post = Post::find($id);
    $this->authorize('delete', $post);
    $post = Post::find($id)->delete();
    $posts = Post::where('user_id',Auth::user()->id)->get();
    return view ('posts.index',['posts'=>$posts]);
}
}