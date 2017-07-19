<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Common;
use App\Http\Model\Admin\Film;
use App\Http\Model\Admin\Film_type;
use App\Http\Model\Admin\FilmPlay;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TypeController extends Common
{
    /**
     *  电影类型(地区)
     */
    public function getIndex()
    {
        $pid = Film_type::where('pid',1) -> lists('id') -> toarray();
        // 通过$pid 查出film的电影信息
        $film = Film::whereIn('area_type',$pid) -> select('id', 'name', 'film_pic', 'price') -> get();

        return view('home.type.type',['title' => '经典影片','film' => $film]);
    }

    
}
