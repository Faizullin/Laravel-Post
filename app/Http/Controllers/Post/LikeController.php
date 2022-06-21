<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,Post $post)
    {
        $data = $request->validate([
            'isLike'=>['required'],
            'post_id'=>['required','integer']
        ]);
        try {
            $like = $request->user()->toggleLikePost($post);
        } catch (Exception $e) {
            return response()->json([
            'action'=>'',
            'message'=>$e,
            ]);
        }
        return response()->json([
            'action'=>'update',
            'liked'=>$like!=null,
        ]);
    }
}
