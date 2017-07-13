<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\Film;
use App\Http\Model\Admin\FilmPlay;
use App\Http\Model\Admin\FilmRoom;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FilmRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 查询出 film_plays 表的所有数据
        $data = FilmPlay::where('rid','like','%%') -> paginate(10);
        // 生成查询电影表和影厅表的条件
        $rids = [];
        $fids = [];
        foreach ($data as $k => $v) {
            $rids[] = $v -> rid;
            $fids[] = $v -> fid;
        }
        // 去掉重复的
        $fids = array_unique($fids);
        $rids = array_unique($rids);
        // 查询电影和影厅信息
        $ridsR = FilmRoom::whereIn('id',$rids) ->lists('name','id') -> all();
        $fidsR = Film::whereIn('id',$fids) ->lists('name','id') -> all();

        $title = '影厅播放列表';
        // 获取当前的时间
        $time = time();
        // 搜索分页需要的变量
        $search = [];
        return view('admin.film_room.index',compact('title','time','data','ridsR','fidsR','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 影厅的信息
        $filmroom = FilmRoom::select('id','name') -> get();
        // 电影的信息
        $film = Film::select('id','name') -> get();
        return view('admin.film_room.create', ['title' => '添加影厅信息', 'film' => $film ,'filmroom' => $filmroom]);
    }

    /**
     * Store a newly created resource in storage.
     *  处理要添加的数据
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 验证表单提交数据的规则
        $this->validate($request, [
            'rid'           => 'min:1|numeric',
            'fid'           => 'min:1|numeric',
            'start_time'    => 'required',
            'end_time'      => 'required',
        ],[
            'rid.min'        => '请选择影厅.',
            'rid.numeric'    => '请选择正确的影厅',
            'fid.min'        => '请选择影片.',
            'fid.numeric'    => '请选择正确的影片',
            'start_time.required'   => '请选择开播时间.',
            'end_time.required'     => '请选择结束时间.',
        ]);
        // 接收提交过来的数据
        $data = $request -> only([
            'rid',
            'fid',
            'start_time',
            'end_time'
        ]);
        // 闪存数据
        $request -> flash();
        // 接收过来的时间是 2017-07-12T01:32:40 , 以下代码是把 T 踢掉并转化成时间戳
        $data['start_time'] = strtotime(str_replace('T',' ',$data['start_time']));  // 开始时间
        $data['end_time'] = strtotime(str_replace('T',' ',$data['end_time']));      // 结束时间
        // 接收过来的时间必须是数值型并且开始时间小于结束时间
        if (!is_numeric($data['start_time']) || !is_numeric($data['end_time']) || ($data['start_time'] >= $data['end_time'])) {
            return back() -> with('error','时间错误');
        }

        // 通过id 降序查出 end_time 值
        $user = FilmPlay::orderBy('id','desc') -> select('end_time') -> first();
//        播放次数自增
        Film::find($data['fid']) -> increment('play');
        if ($user) {
            // 结束时间
            $end_time = $user -> end_time ;
            // 影厅名字
            $name = $user -> name;
            // 判断该影厅的电影结束时间必须小于 $data['start_time'] (要添加的时间)
            if ($name && $end_time >= $data['start_time']) {
                return back() -> with('error','该时间段已安排了别的电影');
            }
        }

        // 执行添加
        $res = FilmPlay::create($data);
        if ($res) {
            return redirect('admin/filmroom') -> with('success', '添加成功');
        } else {
            return back() -> with('error','添加失败');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     * 加载要修改的视图
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data = FilmPlay::find($id);
        // 影厅的信息
        $filmroom = FilmRoom::select('id','name') -> get();
        // 电影的信息
        $film = Film::select('id','name') -> get();
        return view('admin.film_room.edit',['title' => '修改播放信息','data' => $data,'filmroom' => $filmroom ,'film' => $film ]);
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
        // 验证表单提交数据的规则
        $this->validate($request, [
            'rid'           => 'min:1|numeric',
            'fid'           => 'min:1|numeric',
            'start_time'    => 'required',
            'end_time'      => 'required',
        ],[
            'rid.min'        => '请选择影厅.',
            'rid.numeric'    => '请选择正确的影厅',
            'fid.min'        => '请选择影片.',
            'fid.numeric'    => '请选择正确的影片',
            'start_time.required'   => '请选择开播时间.',
            'end_time.required'     => '请选择结束时间.',
        ]);
        // 接收提交过来的数据
        $data = $request -> only([
            'rid',
            'fid',
            'start_time',
            'end_time'
        ]);
        // 根据表单传过来的id来查出数据库的这条数据
        $filmplay = FilmPlay::find($id);

        // 接收过来的时间是 2017-07-12T01:32:40 , 以下代码是把 T 踢掉并转化成时间戳
        $data['start_time'] = strtotime(str_replace('T',' ',$data['start_time']));  // 开始时间
        $data['end_time'] = strtotime(str_replace('T',' ',$data['end_time']));      // 结束时间
        // 接收过来的时间必须是数值型并且开始时间小于结束时间
        if (!is_numeric($data['start_time']) || !is_numeric($data['end_time']) || ($data['start_time'] >= $data['end_time'])) {
            return back() -> with('error','时间错误');
        }
        // 通过传过来 $id 查出 这条数据的 end_time 值
        $user = FilmPlay::where('id',$id) -> select('end_time') -> first();
        if ($user) {
            // 结束时间
            $end_time = $user -> end_time ;
            // 判断该影厅的电影结束时间必须小于 $data['start_time'] (要修改的时间)
            if ($end_time >= $data['start_time']) {
                return back() -> with('error','该时间段已安排了别的电影');
            }
        }


        // 执行修改数据
        if ($filmplay -> update($data)) {
            return redirect('admin/filmroom') -> with('success','修改成功');
        } else {
            return back() -> with('error','修改失败');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 根据ajax传过来的id获取数据库对应的数据
        $res = FilmPlay::where('id',$id) -> delete();
        // 执行删除数据库的对应数据
        if ($res) {
            return ['status' => 0,'msg' => '删除成功' ];
        } else {
            return [ 'status' => 1, 'msg' => '删除失败'];
        }

    }
}
