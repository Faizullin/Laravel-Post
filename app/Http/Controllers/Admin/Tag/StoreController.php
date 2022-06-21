<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Admin\Tag\BaseController;
use App\Http\Requests\Admin\Tag\StoreRequest;

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
