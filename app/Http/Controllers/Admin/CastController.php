<?php
/**
 * auth 项英杰
 * 2017年7月7日 09:28:03
 */

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\Cast;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CastController extends Controller
{
    /**
     * 演员列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
//        $data = Member::where('');
        $page = $req -> input('page',1);
        $search = $req -> input('search', '');

        $res = Cast::where('name', 'like', "%{$search}%") -> paginate(10);

        $tmp = '';
        foreach ($req -> all() as $k => $v){
            $tmp .= "&{$k}={$v}";
        }

        return view('admin.cast.index', ['title' => '演员查看', 'data' => $res, 'tmp' => $tmp, 'search' => $req -> all()]);
    }

    /**
     * 演员添加第一步
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cast.create', ['title' => '演员添加']);
    }

    /**
     * 演员添加第二步
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 验证表单提交数据的规则
        $this->validate($request, [
            'name'  =>'required',
            'sex'       =>'required|in:w,x,m',
        ],[
            'name.required'    => '请输入演员名。',
            'sex.required'      => '必须选择性别。',
            'sex.in'            => '请正确选择性别。',
        ]);

//        分别获取数据以便添加到不同表中
        $data = $request -> only([
            'name',
            'description',
            'sex'
        ]);

        $data['ctime'] = $data['utime'] = time();


        $res = Cast::create($data);
//        判断结果
        if ($res){
            return redirect('admin/cast') -> with('success', '添加成功');
        }else{
            return back() -> with('error', '添加失败');
        }
    }

    /**
     * 演员详情
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Cast::find($id);
        $title = '演员详情';
        return view('admin.cast.show', compact('data', 'title'));
    }

    /**
     * 更新演员 第一步
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cast = Cast::find($id);
        return view('admin.cast.edit', ['data' => $cast, 'title' => '演员编辑']);
    }

    /**
     * 更新演员信息 第二步
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 验证表单提交数据的规则
        $this->validate($request, [
            'name'  =>'required',
            'sex'       =>'required|in:w,x,m',
        ],[
            'name.required'    => '请输入演员名。',
            'sex.required'      => '必须选择性别。',
            'sex.in'            => '请正确选择性别。',
        ]);

        $cast = Cast::find($id);
        $cast -> name = $request -> input('name');
        $cast -> description = $request -> input('description');
        $cast -> sex = $request -> input('sex');

        if ($cast -> update()) {
            return redirect('admin/cast') -> with('success', '修改成功。');
        } else {
            return back() -> with('error', '修改失败。');
        }
    }

    /**
     * 删除演员信息
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return ['status' => 400, 'msg' => '数据珍贵暂不提供删除,请直接修改即可.'];
        if (Cast::find($id) -> delete()) {
            $status = 0;
            $msg = '演员删除成功。';
        } else {
            $status = 500;
            $msg = '删除失败了，请重试。';
        }
        return ['status' => $status, 'msg' => $msg];
    }
}
