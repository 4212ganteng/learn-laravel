<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // get post
        $posts = Post::latest()->paginate(5);
        // render on view
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // field  request to store data
        // validate form
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);

        // upload image
        $image = $request->file('image');
        $image ->storeAs('public/posts', $image->hashName());


        // create post
        Post::create([
            'image' => $image->hashName(),
            'title' => $request->title,
            'content' => $request->content
        ]);

        // redirect to index
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Disimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get darta by id
        $post = Post::find($id);

        // render view
        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //validate form
        $this->validate($request,[
            'image' => 'image|mimes:png,jpg,jpeg,gif,svg|max:2048',
            'title' => 'required|min::5',
            'content' => 'required|min:10'

        ]);

        // check if image is upload
        if($request->hasFile('image')){

             // upload new image
        $image = $request->file('image');
        $image->storeAs('public/posts/',$image->hashName());

        // delete old image
        Storage::delete('public/posts'.$post->image);

        // update post with new image
        $post->update([
            'image' => $image->hashName(),
            'title'=> $request->title,
            'content' =>$request->content
        ]);
        
    }else{
        // update post without image
        $post->update([
            'title' => $request->title,
            'content' => $request->content
        ]);

        // redirect to index

        return redirect()->route('posts.index')->with(['success'=>'data berhasil di update']);

    }   

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //delete  image
        Storage::delete('public/posts'. $post->image);

        // delete post
        $post->delete();


        // return index

        return redirect()->route('post.index')->with(['success'=>'data berhasil di hapus']);
    }
}
