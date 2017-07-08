<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\Film_type;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $data = Film_type::orm('path', ',', 'id')   -> get();
        $data = DB::select('select *,concat(path,id) npath from xxoo_film_types order by npath asc');
//        $data2 = Film_type::select('*',"CONCAT(path, id)") -> orderBy('npath') -> get();
        foreach ($data as $k => $v){
            $data[$k] ['_name']  = str_repeat('┝━', substr_count($v['path'] , ',') - 1) . $v ['name'] ;
        }
        $title = '分类查看';
        return view('admin.type.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.type.create',['title' => '添加分类']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>'required'
        ],[
            'name.required'     => '分类必须填写。'
        ]);
//        获取数据
        $data = $request -> only(['name','pid']);
        $data['path'] = $request -> input('pid') != 0?'0,'.$request -> input('pid').',':'0,';
//        添加数据并判断
        if(Film_type::create($data))
            return redirect('admin/type') -> with('success', '添加成功。');
        else
            return back() -> with('error', '添加失败，请稍候重试。');
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
        $data = Film_type::find($id);
        $title = '';
        return view('admin.type.edit', compact('data', 'title'));
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
        $this->validate($request, [
            'name'      =>'required'
        ],[
            'name.required'     => '分类必须填写。'
        ]);
        $data = $request -> only(['pid', 'name']);
        $data['path'] = '0,'.$request -> input('pid').',';
        $type = Film_type::find($id);
        if($type -> update($data)){
            return redirect('admin/type') -> with('success', '修改成功。');
        } else {
            return back() -> with('error', '修改失败。');
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
        return ['status'=> 403, 'msg' => '数据宝贵，请直接修改。'];
        if (Film_type::find($id) -> delete()) {
            $status = 0;
            $msg = '分类删除成功。';
        } else {
            $status = 500;
            $msg = '删除失败了，请重试。';
        }
        return ['status' => $status, 'msg' => $msg];
    }
}
