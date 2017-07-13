<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Common;
use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends Common
{
    public function getIndex()
    {
        return view('home.index.index');
    }
}
