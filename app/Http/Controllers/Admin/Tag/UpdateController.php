<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Admin\Tag\BaseController;
use App\Http\Requests\Admin\Tag\UpdateRequest;
use App\Models\Tag;

class UpdateController extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdateRequest $request,Tag $tag)
    {
        $data=$request->validated();
        $this->service->update($data,$tag);
        return redirect()->route('admin.tag.show', $tag->id );
    }
}
