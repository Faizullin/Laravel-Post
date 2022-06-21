<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Like;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Post $post)
    {
        if(!$post){
            return redirect()->route('post.index');
        }
        
        return view('post.show')->with([
            'post'=>$post,
            'categories'=>Category::all(),
            'tags'=>Tag::all(),
            "post_created_at"=>Carbon::parse($post->created_at),
        ]);
    }
}
