<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Admin\Category\BaseController;
use Illuminate\Http\Request;
use App\Models\Category;
class MultiDeleteController extends BaseController
{

    public function __invoke(Request $request)
    {
        try {
            if($request->has('ids[]')){
                $category_ids = $request->input('ids[]');
            }else{
                return response(['action'=>'','data'=>"Not found ids[]"]);
            }
            
        } catch (\Exception $exception) {
            return response(['action'=>'','data'=>$exception->getMessage()]);
        }
        $res = $this->service->multidelete($category_ids);
        return response()->json(['action'=>'reload']);
    }
}