<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Admin\Post\BaseController;
use Illuminate\Http\Request;

class MultideleteController extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try {
            $post_ids = $request->input('ids[]');
        } catch (\Exception $exception) {
            return response(['action'=>'','data'=>$exception->getMessage()]);
        }
        $res = $this->service->multidelete($post_ids);
        return response()->json(['action'=>'reload']);
    }
}
