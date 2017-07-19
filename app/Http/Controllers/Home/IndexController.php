<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Common;
use App\Http\Model\Admin\Film;
use App\Http\Model\Admin\FilmPlay;
use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends Common
{
    public function getIndex()
    {
        $playing = FilmPlay::where('start_time','>',time()) -> select('fid') -> get();
//        $playing = $playing -> detail();
        $tmp = array();
        foreach ($playing as $k => $v){
            $tmp[] = $v -> fid;
        }
        $tmp = array_unique($tmp);
        $title = '首页';
        $film = Film::whereIn('id',$tmp) -> select('id', 'name', 'film_pic', 'price') ->take(5) -> get() -> all();
        return view('home.index.index', compact('film', 'title'));
    }
}
