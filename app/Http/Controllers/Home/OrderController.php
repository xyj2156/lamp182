<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Admin\Film;
use App\Http\Model\Admin\FilmPlay;
use App\Http\Model\Admin\FilmRoom;
use App\Http\Model\Admin\Orders;
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

        return view('home.order.start', compact('fid','room', 'film', 'playing', 'title'));
    }

    /** 提交座位信息到这里
     * @param Request $req
     * @return array
     */
    public function postIndex(Request $req)
    {
        $seat = $req -> input('seat', null);
        $fid = $req -> input('fid', null);
        $room = $req -> input('rid',null);
        $pid = $req -> input('pid', null);
        if(!$seat || !$room || !$fid || !$pid) return [
            'status' => 403,
            'msg' => '信息不完整....'
        ];


        $key = 'set:room:'.$fid;
//        将字符串转化成数组
        $arr = explode(',',$seat);
//        检测购买未付款的座位是否卖出
        $mem_room_list = 'list:room:'.$fid;
        $mem = Redis::lrange($mem_room_list, 0, -1);
        foreach ($mem as $v){
            $tmpKey = 'set:room:'.$fid.':'.$v;
            foreach ($arr as $vv){
                if(Redis::sismember($tmpKey,$vv)){
                    return [
                        'status' => 400,
                        'msg' => '座位已售出,请刷新后重选.'
                    ];
                }
            }
        }

//        检测集合中有没有这个座位
        foreach ($arr as $k => $v){
            if(Redis::sismember($key,$v)){
                return [
                    'status' => 400,
                    'msg' => '座位已售出,请刷新后重选.'
                ];
            }
        }
        $name = date('YmdHis').md5(rand(10000000,999999));
        $price = Film::where('id',$fid) -> select('price') -> first() -> price;
        $res = Orders::insert([
            'fid' => $fid,
            'rid' => $room,
            'seat' => $seat,
            'name' => $name,
            'num' => substr_count($seat, ',')+1,
            'price' => $price,
            'ctime' => time(),
            'pid' => $pid,
        ]);
        if($res) {
//        集合存储临时座位信息
            Redis::rpush($mem_room_list,session('home_user') -> id);
            $tmp = $key.':'.session('home_user') -> id;
            foreach ($arr as $k => $v){
                Redis::sadd($tmp, $v);
            }
            return ['status' => 0, 'msg' => '购买成功', 'name' => $name];
        } else {
            return ['status' => 403, 'msg' => '购买出现问题....请重试....'];
        }
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

    /** 获取座位售出信息
     * @param Request $req
     * @return array
     */
    public function postSeat(Request $req)
    {
        $id = $req -> input('id', null);
        if(is_null($id)) return ['status' => 402 ,'msg' => '请按照套路出牌....'];
        $key = 'set:room:'.$id;
        return Redis::smembers($key);
    }

    /** 成功后跳转页面
     * @param Request $req
     */
    public function getSuccess(Request $req)
    {
        $name = $req -> input('name');
        if(!$name) return back() -> with('error', '请按套路出牌....');
        $res = Orders::where('name',$name) -> select('fid', 'pid', 'rid', 'seat', 'num', 'price','ctime') -> first();
        if(!$res) return back() -> with('error', '1请按套路出牌....');
        $tmp = $res -> ctime - time() + 15*60;
        $min = intval($tmp/60);
        $sec = $tmp%60;
        if($min <= 0 || $sec <= 0) {
            Orders::where('name', $name) -> update(['status' => 3]);
            return back() -> with('error', '订单超时... 请重新下单...');
        }
        $title = '下单成功....';
        $film = Film::find($res -> fid,['name']) -> name;
        $room = FilmRoom::find($res -> rid, ['name']) -> name;
        $start = FilmPlay::find($res -> pid, ['start_time']) -> start_time;
        return view('home.order.success', compact('res', 'title', 'film', 'room', 'start', 'name', 'min', 'sec'));
    }

    public function postSuccess(Request $req)
    {
        $id = $req -> orderId;
        dd($req -> all());
    }
}
