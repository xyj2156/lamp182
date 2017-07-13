<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//引入模型
use App\Http\Model\Admin\Review;
use App\Http\Model\Admin\Member;
use App\Http\Model\Admin\Film;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //接收查询条件
        $search = $request -> input('search','');
        //根据用户名取出对应评论
        $member = Member::select('id','username')->where('username','like',"%{$search}%")->get();
        $uids = [];
        foreach($member as $k=>$v){
            $uids[] = $v->id;
        }
        $data = Review::whereIn('mid',$uids)->orderBy('time','desc')->paginate(10);
        //为每条评论找到对应用户名
        foreach($data as $k=>$v){
            foreach($member as $kk=>$vv){
                if($vv -> id == $v -> mid){
                    $data[$k]->username = $vv->username;
                }
            }
        }
        //根据评论fid取出相应电影名
        $fids = [];
        foreach($data as $k => $v){
            $fids[] = $v -> fid;
        }
        $fids = array_unique($fids);
        $film = Film::select(['id','name'])->whereIn('id',$fids)->get();
        //找出每个评论的评论电影
        foreach($film as $k => $v){
            foreach($data as $kk => $vv){
                if($v->id == $vv->fid){
                    $data[$kk]->filmName = $v->name;
                }
            }
        }

        return view('admin.review.index',['data'=>$data,'search'=>$request->all(),'username'=>$search,'title' => '用户评论搜索']);
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
     * 查看电影评论
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$fid)
    {
        //取出电影名称
        $filmName = Film::select(['name'])->where('id',$fid)->get()[0]->name;
        //根据 fid 取出电影的评论
        $data = Review::where('fid',$fid)->orderBy('time','desc')->paginate(10);
        
        //根据 mid 取出评论对应的用户
        $mids = [];
        foreach($data as $k => $v){
            $mids[] = $v->mid;
        }
        $mids = array_unique($mids);
        $member = Member::select(['id','username'])->whereIn('id',$mids)->get();
        //给每条评论写上用户名
        foreach($member as $k => $v){
            foreach($data as $kk => $vv){
                if($v->id == $vv->mid){
                    $data[$kk] -> username = $v -> username;
                }
            }
        }


        return view('admin.review.show',['data'=>$data,'filmName'=>$filmName,'search'=>$request->all(),'fid'=>$fid,'title' => "{$filmName} 的评论"]);
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
        //删除指定数据
        $res = Review::where('id',$id)->delete();
        //返回删除结果
        if($res){
            return ['status' => 0, 'msg' => '删除成功。。'];
        }else{
            return ['status' => 500, 'msg' => '内部处理错误，请稍候再试 。。'];
        }
    }
}
