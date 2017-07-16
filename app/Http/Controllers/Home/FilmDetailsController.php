<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Common;
use App\Http\Model\Admin\Film;
use App\Http\Model\Admin\Film_type;
use App\Http\Model\Admin\FilmDetail;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FilmDetailsController extends Common
{
    public function index($id)
    {
        // 通过传过来的$id 查出 电影详情
        $film = Film::find($id);
        $filmdetail = FilmDetail::find($id);
        // 点击自增
        $film -> increment('click');
        $title = '电影详情';
        // 获取演员对象集合
        $cast = $film -> cast;
        // 获取$film的_type类型
        $_type = $film -> _type;
        // 查出电影类型
        $type = Film_type::where('id',$_type) -> select('name') -> first();

        return view('home.filmdetails.filmdetails',compact('film','title','filmdetail','cast','type'));
    }
}
