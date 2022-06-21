<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Admin\Tag\BaseController;
use App\Models\Tag;
use Illuminate\Http\Request;

class DeleteController extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Tag $tag)
    {
        $tag->delete();
        return response()->json(['status'=>True,"action"=>'reload']);
    }
}
