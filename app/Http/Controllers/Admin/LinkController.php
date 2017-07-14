<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\Link;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.link.index', ['data' => Link::orderBy('order','asc') -> get(), 'title' => '友情链接']);
    }

    /**
     * Show the form for creating a new resource.
     * 加载添加友情链接视图
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.link.create', ['title' => '添加友情链接']);
    }

    /**
     * Store a newly created resource in storage.
     *  处理添加的信息
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 验证表单提交数据的规则
        $this->validate($request, [
            'linkname'  => 'required',
            'linktitle'  => 'required|max:50',
            'linkurl'       =>'required|min:0|max:100',
            'linkthumb' => 'required'
        ],[
            'linkname.required'    => '必须输入链接名',
            'linkthumb.required'    => '必须选择缩略图',
            'linktitle.required' => '必须输入链接标题',
            'linktitle.max' => '标题名太长了',
            'linkurl.required' => '必须输入url地址',
            'linkurl.min' => 'url地址太短了',
            'linkurl.max' => 'url地址太长了',
        ]);
        // 获取要添加的数据
        $data = $request -> only([
            'linkname',
            'linktitle',
            'linkurl',
            'linkthumb'
        ]);

        // 把数据添加到数据库
        $res = Link::create($data);
        if ($res) {
            session(['admin_thumb_path' => null]);
//            生成配置文件
            $this -> conf();
            return redirect('admin/link') -> with('success','添加成功');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     * 加载修改视图
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Link::find($id);
        return view('admin.link.edit',['data' => $data, 'title' => "编辑<{$data -> linkname}>友情链接"]);
    }

    /**
     * Update the specified resource in storage.
     *  处理要修改的数据
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 验证表单提交数据的规则
        $this->validate($request, [
            'linkname'  => 'required',
            'linktitle'  => 'required|max:50',
            'linkurl'       =>'required|min:0|max:100',
            'linkthumb' => 'required'
        ],[
            'linkname.required'    => '必须输入链接名',
            'linkthumb.required'    => '必须选择缩略图',
            'linktitle.required' => '必须输入链接标题',
            'linktitle.max' => '标题名太长了',
            'linkurl.required' => '必须输入url地址',
            'linkurl.min' => 'url地址太短了',
            'linkurl.max' => 'url地址太长了',
        ]);// 接收要修改的数据
        $data = $request -> only([
            'linkname',
            'linktitle',
            'linkurl',
            'linkthumb'
        ]);
        // 根据表单传过来的id来查出数据库的这条数据
        $user = Link::find($id);
        // 取出这条数据对应的 linkthumb
        $file = public_path().$user -> linkthumb;
        // 执行修改
        if ($user -> update($data)) {
            session(['admin_thumb_path' => null]);
            // 执行删除旧缩略图
            if(is_file($file)){
                unlink($file);
            }
//            生成配置文件
            $this -> conf();
            return redirect('admin/link') -> with('success','修改成功');
        } else {
            return back() -> with('error','修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *  处理删除的数据
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 根据ajax传过来的id获取数据库对应的数据
        $user = Link::find($id);
        // 数据库的 linkthumb
        $file = public_path().$user -> linkthumb;
        // 执行删除数据库的对应数据
        $res1 = $user -> delete($user);
        if ($res1) {
            // 删除对应的缩略图
            if (is_file($file)) {
                $res2 = unlink($file);
            }
//            生成配置文件
            $this -> conf();
            return ['status' => 0, 'msg' => '删除成功..'];
        } else {
            return ['status' => 1, 'msg' => '删除失败..'];
        }
    }

    /** 排序函数/方法 2017年7月14日 22:14:11 author 项英杰 只是添加了注释
     * 同时修改了下返回信息
     * @param $id
     * @param $order
     * @return array
     */
    public function order($id, $order)
    {
        $res = Link::find($id);
        $res -> order = $order;
        if($res -> save()){
//            生成配置文件
            $this -> conf();
            $code = 0;
            $msg = '修改排序成功';
        }else{
            $code = 400;
            $msg = '修改排序失败';
        }

        return ['status' => $code, 'msg' => $msg];
    }

    /**
     * 生成配置文件
     */
    public function conf()
    {
        $res = Link::where('order', '>', 0) -> OrderBy('order') -> get();
        file_put_contents(config_path().'/link.php','<?php return '.var_export($res -> toArray(),true).';');
    }
}
