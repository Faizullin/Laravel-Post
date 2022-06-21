<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,Comment $comment)
    {
        $comment->delete();
        if ($request->ajax()) {
            return response()->json([
                'status'=>true,
                'action'=>'update',
                'id'=>$comment->id,
            ]);
        }
        return back();
    }
}
