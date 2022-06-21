<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Post\BaseController;
use App\Http\Requests\Post\DeleteRequest;
use App\Models\Post;

class DeleteController extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(DeleteRequest $request,Post $post)
    {
        $data = $request->validated();
        $post->delete();
        if($request->ajax()){
            return response()->json([
                'action'=>'reload',
                'status'=>true,
            ]);
        }
        return back();
    }
}
