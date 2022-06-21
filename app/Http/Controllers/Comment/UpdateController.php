<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Comment\BaseController;
use App\Http\Requests\Comment\UpdateRequest;
use Illuminate\Http\Request;

class UpdateController extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdateRequest $request,Comment $comment)
    {
        $data  = $request->validated();
        $data = $this->service->update($data,$comment);
        return redirect()->route('home');
    }
}
