<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RegController extends Controller
{
    public function reg()
    {
        return view('home.reg.reg',['title' => '注册']);
    }
}
