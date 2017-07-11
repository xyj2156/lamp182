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
        $data2 = Cast::where('id', 'in',['1,2,3']) -> get();
//        $data = Cast::find($id) -> film;
        dump($data2);
    }
}