<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Common;
use App\Http\Model\Admin\Film;
use App\Http\Model\Admin\Film_type;
use App\Http\Model\Admin\FilmDetail;
use App\Http\Model\Admin\FilmPlay;
use App\Http\Model\Admin\FilmRoom;
use App\Http\Model\Admin\Member_detail;
use App\Http\Model\Admin\Review;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FilmDetailsController extends Common
{
    /**
     * @param $id
     * 加载电影详情
     */
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
        // 获取$film id
        $fid = $film -> id;
        // 查出电影类型
        $type = Film_type::where('id','>',3) -> select('id','name') -> lists('name','id') -> toArray();
        // 通过$film的id 来查询出对应的电影评论
        $reciew = Review::where('fid',$fid) -> orderBy('time','desc') ->  paginate(5);
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
     * 电影评论
     * 处理ajax传过来的数据
     */
    public function comment(Request $request)
    {
        // 接收ajax数据
        $data = $request -> only([
            'content',
            'fid',
        ]);
        if(!session('home_user')){
            return ['status' => 1,'data' => '请您登录..3秒钟跳转'];
        }
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

    /**
     * @param Request $request
     * 处理购票按钮
     *
     */
    public function movie(Request $request)
    {
        // 影厅弹层
        $data1 = $request -> only([
            'id'
        ]);
        $id = $data1['id'];
        // $filmplay电影播放历史  开始时间 < 当前时间 - 10分钟
        $filmplay = FilmPlay::where('fid',$id) -> select('id','rid') -> where('start_time','<',time()-10*60) -> get();
        $rid = [];
        $id = [];
        foreach($filmplay as $k=>$v){
            // 获取$reciew 的mid
            $rid[] = $v['rid'];
            $id[$v['rid']] = $v['id'];
        }
        // 去重
        $rid = array_unique($rid);
        // 根据rid查出对应的影厅信息
        $filmroom = FilmRoom::whereIn('id',$rid) -> select('id','name','seat') -> get();
        // 影厅名字
        $data = [];
        foreach($filmroom as $k=>$v){
            $data[] = [$v -> name,$id[$v -> id]];
        }
       if(!$data){
            return ['status' => 1,'data' => '该电影已截止购票'];
       } else {
           return ['status' => 0,'data' => $data];
       }

    }



}
