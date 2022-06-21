<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Post\BaseController;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('post.index')->with([
            'posts'=>Post::orderBy('updated_at','DESC')->paginate(5),
            'categories'=>Category::all(),
            'tags'=>Tag::all()
        ]);
    }
}
