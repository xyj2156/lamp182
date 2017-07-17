<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Common;
use App\Http\Model\Admin\Film;
use App\Http\Model\Admin\Film_type;
use App\Http\Model\Admin\FilmDetail;
use App\Http\Model\Admin\Member_detail;
use App\Http\Model\Admin\Review;
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
        // 获取$film id
        $fid = $film -> id;
        // 查出电影类型
        $type = Film_type::where('id',$_type) -> select('name') -> first();
        // 通过$film的id 来查询出对应的电影评论
        $reciew = Review::where('fid',$fid) -> paginate(3);
        $mid = [];
        foreach($reciew as $k=>$v){
            // 获取$reciew 的mid
            $mid[] = $v['mid'];
        }
        // 去重
        $mid = array_unique($mid);
        // 同过$reciew的mid 来查询出对应的前台用户信息
        $memberdetail = Member_detail::whereIn('id',$mid) -> select('id','name','uface') -> get();
        // 把需要的数据整合在 $reciew
        foreach($memberdetail as $k => $v){
            foreach($reciew as $kk => $vv){
                if($v->id == $vv->mid){
                    $reciew[$kk]->name = $v ->  name;
                    $reciew[$kk]->uface = $v -> uface;
                }
            }
        }

        return view('home.filmdetails.filmdetails',compact('film','title','filmdetail','cast','type','reciew'));
    }

    /**
     * @param Request $request
     * 处理ajax传过来的数据
     */
    public function comment(Request $request)
    {
        // 接收ajax数据
        $data = $request -> only([
            'content',
            'fid',
        ]);
        // 评论对应的用户
        $data['mid']  = session('home_user') -> id;
        $data['time'] = time();
        $res = Review::create($data);
        if ($res) {
            return ['status' => 0,'data' => '评论成功'];
        } else {
            return ['status' => 1,'data' => '服务器繁忙,请重新评论'];
        }
    }

}
