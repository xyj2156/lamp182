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
        $film = Film::whereIn('area_type',$pid) -> orderBy('click','desc') -> select('id', 'name', 'film_pic', 'price') -> paginate(10);
        $name = '区域排行';
        return view('home.index.search',['title' => '经典影片','film' => $film,'name' => $name]);
    }

    /**
     * 电影类型(年份)
     */
    public function getYear()
    {
        $pid = Film_type::where('pid',2) -> lists('id') -> toarray();
        // 通过$pid 查出film的电影信息
        $film = Film::whereIn('year',$pid) -> orderBy('play','desc') -> select('id', 'name', 'film_pic', 'price') ->  paginate(10);
        $name = '年份排行';
        return view('home.index.search',['title' => '经典影片','film' => $film,'name' => $name]);
    }

    /**
     * 电影类型(类型)
     */
    public function getType()
    {
        $pid = Film_type::where('pid',3) -> lists('id') -> toarray();
        // 通过$pid 查出film的电影信息
        $film = Film::whereIn('_type',$pid) -> orderBy('click','desc') -> select('id', 'name', 'film_pic', 'price') ->  paginate(10);
        $name = '类型排行';
        return view('home.index.search',['title' => '经典影片','film' => $film,'name' => $name]);
    }



}
