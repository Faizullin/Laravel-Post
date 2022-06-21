<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
    public function __invoke(Request $request,Tag $tag){
        return view('post.index')->with([
            'categories'=>Category::all(),
            'posts'=>$tag->posts()->orderBy('updated_at','DESC')->paginate(5),
            'tags'=>Tag::all()
        ]);
    } 
}
