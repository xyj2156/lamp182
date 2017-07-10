<?php
/**
 * Created by PhpStorm.
 * User: JiefKing
 * Date: 2017/7/10
 * Time: 12:01
 */

namespace App\Http\Controllers;


use App\Http\Model\Admin\Film;

class test extends Controller
{
    public function test()
    {
        dd(Film::find(39) -> detail);
    }
}