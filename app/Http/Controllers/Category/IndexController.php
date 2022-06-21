<?php

namespace App\Http\Controllers\Category;

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
    public function __invoke(Request $request,Category $category)
    {
        //$cat = Category::where('slug',$category)->first();
        if(!$category){
            return redirect()->route('post.index');
        };
        return view('post.index')->with([
            'categories'=>Category::all(),
            'category'=>$category,
            'posts'=>$category->posts()->orderBy('updated_at','DESC')->paginate(5),
            'tags'=>Tag::all()
        ]);
    }
}
