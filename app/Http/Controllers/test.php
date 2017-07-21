<?php
/**
 * Created by PhpStorm.
 * User: JiefKing
 * Date: 2017/7/10
 * Time: 12:01
 */

namespace App\Http\Controllers;


use App\Http\Model\Admin\Cast;
use App\Http\Model\Admin\Film;

class test extends Controller
{
    public function test()
    {
        echo date('Y-m-d H:i:s',time()+3600);
    }
}