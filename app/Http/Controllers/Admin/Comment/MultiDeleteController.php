<?php

namespace App\Http\Controllers\Admin\Comment;

use App\Http\Controllers\Admin\Comment\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MultiDeleteController extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //dd($request->input());
        try {
            if($request->has('ids')){
                $category_ids = $request->input('ids');
            }else{
                return response(['action'=>'','data'=>"Not found ids"]);
            }
            
        } catch (\Exception $exception) {
            return response(['action'=>'','data'=>$exception->getMessage()]);
        }
        $res = $this->service->multidelete($category_ids);
        return response()->json(['action'=>'reload']);
    }
}
