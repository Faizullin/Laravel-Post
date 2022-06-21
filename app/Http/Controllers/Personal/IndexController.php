<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
      $user = auth()->user();
      //$this->authorize('view',$user);
      return view('personal.index')->with(['user'=>$user,'user_posts'=>$user->posts()->orderBy('updated_at','DESC')->paginate(5)]);
    }
}
