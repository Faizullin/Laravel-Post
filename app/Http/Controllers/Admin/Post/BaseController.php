<?php
namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Services\Post\Service;


class BaseController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public $service;
    public function __construct(Service $service)
    {
        $this->service=$service;
    }

}