<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate(['keyword'=>'required | string | max: 100']);
        $posts = Post::where('title','LIKE','%'.$data['keyword']."%");
        if($request->has('live')){
            $maxNumber = 5;
            $tags = [];
            $postNumber = $posts->count();
            if($postNumber < $maxNumber){
                $tags = Tag::where('title','LIKE','%'.$data['keyword']."%")->take($maxNumber-$postNumber)->get();
                $posts = $posts->take($postNumber)->get();
            }else{
                $posts = $posts->take($maxNumber)->get();
            }
            return response()->json([
                'tags'=>$tags,
                'posts'=>$posts,
            ]);
        }
        return view('post.index')->with([
            'posts'=>$posts->orderBy('updated_at','DESC')->paginate(5),
            'categories'=>Category::all()
        ]);
    }
}
