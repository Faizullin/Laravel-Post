<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Admin\Category\BaseController;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category;

class UpdateController extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdateRequest $request,Category $category)
    {
        $data=$request->validated();
        
        $this->service->update($data,$category);
        return redirect()->route('admin.category.show',$category->id);
    }
}
