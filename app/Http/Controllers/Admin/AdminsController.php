<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\Admin;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Monolog\Handler\IFTTTHandler;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     * 加载管理员列表
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request -> input('search','');
        $data =  Admin::where('username','like',"%{$search}%") -> paginate(3);
        return view('admin.admins.index',['title' => '管理员列表','data' => $data,'search' => $request -> all()]);
    }

    /**
     * Show the form for creating a new resource.
     * 加载添加管理员的视图
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admins.create',['title' => '管理员添加']);
    }

    /**
     * Store a newly created resource in storage.
     * 处理添加数据
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 验证表单提交数据的规则
        $this->validate($request, [
            'username'  =>'regex:/^[a-zA-Z_]\w{5,17}$/',
            'password'  =>'required|between:6,18',
            'email'     =>'required|email',
            'phone'     =>'regex:/^1[34578][0-9]{9}$/',
            'uface'     => 'required'
        ],[
            'username.regex'    => '请正确输入用户名。',
            'password.required' => '必须输入密码',
            'password.between'  => '密码长度必须在6-18位之间',
            'email.required'    => '必须输入邮箱。',
            'email.email'       => '请正确输入邮箱。',
            'phone.regex'       => '请输入正确手机号码。',
            'uface.required'    => '必须选择头像'
        ]);
        // 接收要添加的数据
        $data = $request -> only([
            'username',
            'password',
            'phone',
            'email',
            'uface'
        ]);
        // 加密密码
        $data['password'] = Crypt::encrypt($data['password']);
        // 第一次创建管理员的时间
        $data['ctime'] = time();
        // 执行插入数据库
        $res = Admin::create($data);
        if ($res) {
            session(['admin_face_path' => null]);
            return redirect('admin/admins') -> with('success', '添加成功');
        } else {
            return back() -> with('error', '添加失败');
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
     *  加载要修改的视图
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 接收要修改的数据
        $data = Admin::find($id);
        // 解密 (让视图显示出正常的密码)
        $data['password'] = Crypt::decrypt($data['password']);
        // 把数据传到edit视图
        return view('admin.admins.edit',['title' => '修改管理员','data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     * 处理要修改的数据
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 验证表单提交数据的规则
        $this->validate($request, [
            'username'  =>'regex:/^[a-zA-Z_]\w{5,17}$/',
            'password'  =>'required|between:6,18',
            'email'     =>'required|email',
            'phone'     =>'regex:/^1[34578][0-9]{9}$/',
        ],[
            'username.regex'    => '请正确输入用户名。',
            'password.required' => '必须输入密码',
            'password.between'  => '密码长度必须在6-18位之间',
            'email.required'    => '必须输入邮箱。',
            'email.email'       => '请正确输入邮箱。',
            'phone.regex'       => '请输入正确手机号码。',
        ]);
        // 接收要修改的数据
        $data = $request -> only([
            'username',
            'password',
            'phone',
            'email',
            'uface'
        ]);
        // 让密码加密
        $data['password'] = Crypt::encrypt($data['password']);

        // 根据传过来的id查询数据库对应的数据
        $user = Admin::find($id);
        // 从 $data 里取出的 uface
        $uface = $data['uface'];
        // 如果data的uface是空,销毁掉 (目的: 不让它把数据库的uface值修改成空)
        if (empty($data['uface']))unset($data['uface']);
        // 取出这条数据对应的 uface (数据库的头像路径)
        $file = public_path().$user -> uface;
        // 执行修改
        if ( $user -> update($data) ) {
            // 清空session的头像路径
            session(['admin_face_path' => null]);
            // 执行删除旧头像
            if($uface && is_file($file)){
                if ( $user -> uface ) {
                    unlink($file);
                }
            }
            return redirect('admin/admins') -> with('success','修改成功');
        } else {
            return back() -> with('error','修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     * 处理要删除的数据
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 根据ajax传过来的id获取数据库对应的数据
        $user = Admin::find($id);
        // 取出这条数据对应的 uface (头像路径)
        $file = public_path().$user -> uface;
        // 执行删除
        if ($user -> delete($user)) {
            // 删除对应的缩略图
            if ( is_file($file) ) {
                unlink($file);
            }
            //  0 代表成功
            return ['status' => 0, 'msg' => '删除成功'];
        } else {
            return ['status' => 1, 'msg' => '删除失败'];
        }

    }
}
