<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    
    public function home()
    {
        return view('home');
    }
    public function about()
    {
        return view('about');
    }

}
