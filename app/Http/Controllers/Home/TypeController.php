<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Common;
use App\Http\Model\Admin\Film;
use App\Http\Model\Admin\FilmPlay;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TypeController extends Common
{
    public function getIndex()
    {
        $playing = FilmPlay::select('fid') -> get();
//        dd($playing);
//        $playing = $playing -> detail();
        $tmp = array();
        foreach ($playing as $k => $v){
            $tmp[] = $v -> fid;
        }
        $tmp = array_unique($tmp);
        $film = Film::whereIn('id',$tmp) -> select('id', 'name', 'film_pic', 'price','_type','area_type','year') -> get() -> all();
//        dd($playing,$film);
        return view('home.type.type',['title' => '经典影片','film' => $film]);
    }
}
