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
use App\Http\Model\Admin\FilmPlay;

class test extends Controller
{
    public function test()
    {
        dump(FilmPlay::where('fid',3) -> select('start_time')  -> first() -> start_time);
        dump(date('Y-m-d H:i:s',FilmPlay::where('fid',3) -> select('start_time')  -> first() -> start_time));
        dump(date('Y-m-d H:i:s',time()-10*60));

        dd(FilmPlay::where('fid',3) -> select('id','rid','start_time') -> where('start_time','<',time()-10*60) -> get());

    }
}