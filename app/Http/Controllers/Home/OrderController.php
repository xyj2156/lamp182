<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Admin\FilmPlay;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $req)
    {
        $fid = $req -> input('id',0);
        if($fid === 0) return back() -> with('error', '请按照套路出牌....');
        $playing = FilmPlay::find($fid);
        if(!$playing) return back() -> with('error', '请按照套路出牌....');

        $room = $playing -> room;
        $film = $playing -> detail;
        $title = $film -> name.' 座位信息 ';

        return view('home.order.buy1', compact('fid','room', 'film', 'playing', 'title'));
    }

    /** 提交座位信息到这里
     * @param Request $req
     * @return array
     */
    public function postIndex(Request $req)
    {
        $seat = $req -> input('seat', null);
        $room = $req -> input('id', null);
        if(!$seat || !$room) return [
            'status' => 403,
            'msg' => '信息不完整....'
        ];

        $key = 'set:room:'.$room;
//        将字符串转化成数组
        $arr = explode(',',$seat);
//        检测集合中有没有这个座位
        foreach ($arr as $k => $v){
            if(Redis::sismember($key,$v)){
                return [
                    'status' => 400,
                    'msg' => '座位已售出,请刷新后重选.'
                ];
            }
        }
//        集合存储座位信息
        foreach ($arr as $k => $v){
            Redis::sadd($k,$v);
        }
        return ['status' => 0, 'msg' => '购买成功'];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getSeat(Request $req)
    {
        $id = $req -> input('id', null);
        if(is_null($id)) return ['status' => 402 ,'msg' => '请按照套路出牌....'];
        $key = 'list:'.$id;
        dd(\Redis::get($key));
    }
}
