<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Admin\Category\BaseController;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\Category\StoreRequest;
class StoreController extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $this->service->store($data);
        return back();
    }
}
