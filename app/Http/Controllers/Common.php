<?php
/**
 * Created by PhpStorm.
 * User: JiefKing
 * Date: 2017/7/13
 * Time: 20:18
 */

namespace App\Http\Controllers;


use App\Http\Model\Admin\Film;
use App\Http\Model\Admin\FilmDetail;

class Common extends Controller
{
    public function __construct()
    {
        $filmClick = Film::where('click','>=',0) -> select('id','name','click','film_pic', 'price') -> orderBy('click','desc') -> take(10) -> get();
        $filmPlay = Film::where('play','>=',0) -> select('id','name','play','film_pic','price') -> orderBy('play','desc') -> take(10) -> get();

        view() -> share('click',$filmClick);
        view() -> share('play',$filmPlay);
    }
}