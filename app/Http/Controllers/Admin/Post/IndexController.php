<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $posts = [];
        if($request->has('author')){
            $posts = Post::where("user_id",$request->input('author'))->get();
        }elseif ($request->has('tag')) {
            $posts = Tag::where('id',$request->input('tag'))->first()->posts;
        }elseif ($request->has('category')) {
            $posts = Post::where('category_id',$request->input('category'))->get();
        }else{
            $posts = Post::all();
        }

        return view('admin.post.index')->with([

            'posts'=>$posts
        ]);
    }
}
