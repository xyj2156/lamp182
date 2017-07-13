<?php
/**
 * Created by PhpStorm.
 * User: JiefKing
 * Date: 2017/7/13
 * Time: 20:18
 */

namespace App\Http\Controllers;


use App\Http\Model\Admin\Film;

class Common extends Controller
{
    public function __construct()
    {
        $filmClick = Film::orderBy('click','desc') -> take(10) -> get();
        view() -> share('click',$filmClick);
    }
}