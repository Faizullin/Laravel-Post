<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Comment\BaseController;
use App\Http\Requests\Comment\StoreRequest;

class StoreController extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(StoreRequest $request)
    {
        $data=$request->validated();
        $data['user_id'] = $request->user()->id;
        $comment = $this->service->store($data);
        if($request->ajax()){
            $comment->username = $comment->user->name;
            $data=[
                'action'=>'update',
                'comment'=>$comment,
            ];
            return response()->json($data);
        }
        return redirect()->route('post.show',$comment['post_id'])->with([
            'status'=>'Comment added successfully!'
        ]);
    }
}
