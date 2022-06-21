<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\User\BaseController;
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
        $ids = [];
        try {
            if($request->has('ids[]')){
                $ids = $request->input('ids[]');
            }else{
                return response(['action'=>'','data'=>"Not found ids[]"]);
            }
            
        } catch (\Exception $exception) {
            return response(['action'=>'','data'=>$exception->getMessage()]);
        }
        $res = $this->service->multidelete($ids);
        return response()->json(['action'=>'reload']);
    }
}
