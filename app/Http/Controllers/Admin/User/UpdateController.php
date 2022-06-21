<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\User\BaseController;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\User;

class UpdateController extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdateRequest $request,User $user)
    {
        $data = $request->validated();
        $data = $this->service->update($data,$user);
        return redirect()->route('admin.user.show',$user->id);
    }
}
