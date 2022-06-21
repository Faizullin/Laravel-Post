<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Admin\Category\BaseController;
use Illuminate\Http\Request;
use App\Models\Category;
class DeleteController extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,Category $category)
    {
        //$this->service->delete($category);
        $category->delete();
        return response()->json(['status'=>True,"action"=>'reload']);
    }
}
