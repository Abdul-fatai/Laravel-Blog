<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Comment;
use App\Tag;

use DB;

class PostsController extends Controller
{

        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index')->with('posts', $posts);
    }


    // public function search(Request $request){

    //     $search = $request->get('search');
    //     $posts = DB::table('posts')->where('title', 'like', '%' .$search. '%')->paginate(5);
    //     return view('posts.index', ['posts' => $posts]);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $tags = Tag::all();
        return view('posts.create', compact( 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999',
            'tag' => 'required'
        ]);

        // Handle File Upload 
        if ($request->hasFile('cover_image')) {
            //Get filename with the extention
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get Just Ext 
            $filename = pathinfo( $filenameWithExt, PATHINFO_FILENAME);
            //Get  Just Ext
            $extention = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store 
            $fileNameToStore = $filename.'_'.time().'.'.$extention;
            //Uplaod Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else{
            $fileNameToStore = 'noimage.jpg';
        }

        //Create Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->tag_name = $request->input('tag');
        $post->save();

        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $posts = Post::find($id);
        $comment = Comment::select('name', 'message')->where('post_id', $id)->orderBy('created_at', 'desc')->get();
        $posts->comments($comment);
        return view('posts.show')->with('posts', $posts);

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
        $tags = Tag::all();

        //Check for correct USer
        if(Auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        return view('posts.edit', compact('post', 'tags'));

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
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'tag' => 'required'
        ]);

        //Handle File Upload 
        if ($request->hasFile('cover_image')) {
            //Get filename with the extention
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get Just Ext 
            $filename = pathinfo( $filenameWithExt, PATHINFO_FILENAME);
            //Get  Just Ext
            $extention = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store 
            $fileNameToStore = $filename.'_'.time().'.'.$extention;
            //Uplaod Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }
        //Create Post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->tag_name = $request->input('tag');
        if ($request->hasFile('cover_image')) {
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        return redirect('/posts')->with('success', 'Post Updated');
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
         //Check for correct USer
         if(Auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        if ($post->cover_image != 'noimage.jpg') {
            //Delete Image
            Storage::delete('public/cover_images/'.$post->cover_image);

        }
        $post->delete();
        return redirect('/posts')->with('success', 'Post removed');
    }
}
