<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\FilmRoom;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FilmRoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $search = $req -> all();
        $ser = $req -> input('search', '');
        $data = FilmRoom::where('name', 'like', "%{$ser}%") -> paginate(10);
        $title = '影厅信息管理';
        return view('admin.film_room.room_index',compact('data','search','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = '添加影厅';
        return view('admin.film_room.room_create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this ->validate($request,[
            'name' => 'required',
            'seat' => 'required',
            'row' => 'numeric',
            'col' => 'numeric'
        ],[
            'name.required' => '影厅名字必须填写....',
            'seat.required' => '影厅座位信息必须填写...',
            'row.numeric' => '座位信息出错...',
            'col.numeric' => '座位信息出错...'
        ]);

        $data = $request -> only([
            'name',
            'seat',
            'col',
            'row'
        ]);
        $request -> flash();

        if(FilmRoom::create($data))
            return redirect('admin/filmrooms') -> with('success', '添加成功。');
        else
            return back() -> with('error', '添加失败。');
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
        $data = FilmRoom::find($id);
        if(!$data) return back() -> with('error', '影厅未找到...');
        $title = $data -> name . ' 影厅编辑';
        return view('admin.film_room.room_edit', compact('data', 'title'));
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
        $this ->validate($request,[
            'name' => 'required',
            'seat' => 'required',
            'row' => 'numeric',
            'col' => 'numeric'
        ],[
            'name.required' => '影厅名字必须填写....',
            'seat.required' => '影厅座位信息必须填写...',
            'row.numeric' => '座位信息出错...',
            'col.numeric' => '座位信息出错...'
        ]);

        $res = FilmRoom::find($id);
        if(!$res) return back() -> with('error', '影厅未找到...');

        $data = $request -> only([
            'name',
            'seat',
            'col',
            'row'
        ]);

        if($res -> update($data)){
            return redirect('admin/filmrooms') -> with('success', '影厅信息更新成功......');
        }else{
            return back() -> with('error', '影厅信息更新失败，请重试....');
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
        return [
            'status' => 403,
            'msg' => '影厅与影厅播放信息紧密关联,暂不提供删除.如果需要请在 <span style="color: red">app/Http/Controller/Admin/FilmRoomsController.php</span> 第'.__LINE__.'行左右,删除第一个 return 即可.'
        ];
        $res = FilmRoom::find($id);
        if(!$res) return [
            'status' => 404,
            'msg' => '影片未找到....'
        ];


        if($res -> delete())
            return [
                'status' => 0,
                'msg' => '删除成功...'
            ];
        else
            return [
                'status' => 500,
                'msg' => '删除失败,请重试......'
            ];
    }
}
