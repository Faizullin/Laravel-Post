<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Post\BaseController;
use Illuminate\Http\Request;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Post;

class UpdateController extends BaseController{

    public function __invoke(UpdateRequest $request,Post $post)
    {
        $data = $request->validated();
        $data = $this->service->update($data,$post);
        return redirect()->route('post.show',$post->id);
    }
}
