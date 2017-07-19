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

    /**
     * @param Request $req
     *  加载搜索视图
     */
    public function search(Request $req)
    {

        // 搜索表单传过来的search
        $search = $req -> input('search', '');

        $film = Film::where('name', 'like', "%{$search}%") -> paginate(10);
        $name = [];
        foreach($film as $k=>$v){
            $name[] = $v -> name;
        }
        $title = '首页';
        return view('home.index.search', ['title' => $title,'film' => $film, 'search' => $req -> all()]);
    }
}
