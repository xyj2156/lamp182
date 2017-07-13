<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\Orders;
use App\Http\Model\Admin\Member;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;
class OrdersController extends Controller
{
    /**
     * 查询订单
     *auth @黄小康
     * @return 
     */
    public function index(Request $request)
    {
        $search = $request -> input('search','');
        $number = $request -> input('number','');
        //显示所有订单
        if (empty($search)){
        //根据订单mid找到用户
        $data = Orders::where('id','like',"%{$number}%")->orderBy('ctime','desc')->paginate(10);
        if(!$data) return view('admin.orders.index',['data'=>$data,'search'=>$request->all()]);
        $mids = [];
        foreach($data as $k => $v){
            $mids[] = $v -> mid;
        }
        //给每个订单写上用户名
        $mids = array_unique($mids);
        $member = Member::select(['id','username'])->whereIn('id',$mids)->get();
        foreach($data as $k => $v){
            foreach($member as $kk => $vv){
                if($v -> mid == $vv -> id){
                    $data[$k]->username = $vv->username;
                }
            }
            if( empty($data[$k]->username) ) $data[$k]->username = '此订单找不到对应的用户';
        }
        //显示到网页上
        return view('admin.orders.index',['data'=>$data,'search'=>$request->all()]);
        }

        //根据搜寻的用户找订单
        $member = Member::select(['id','username'])->where('username','like',"%{$search}%")->get();

        $uids = [];
        foreach($member as $k => $v)
        {
            $uids[] = $v -> id;
        }
        //拿出对应订单
        $data = Orders::where('id','like',"%{$number}%")->wherein('mid',$uids)->orderBy('ctime','desc')->paginate(10);
        //给每个订单写上用户名
        foreach($data as $k => $v){
            foreach($member as $kk => $vv)
            if($v->mid == $vv->id){
                $data[$k]->username = $vv->username;
            }
        }
        //显示到网页
        return view('admin.orders.index',['data'=>$data,'search'=>$request->all()]);
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
}
