<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class PassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * 加载修改密码的视图
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/pass/pass', ['title' => '密码修改']);
    }

    /**
     * 处理提交的密码信息
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 接收提交的信息
        $data = $request -> except('_token');
        // 验证表单提交数据的规则
        $this->validate($request, [
            'password'=>'required|between:6,18',
            'password_c'=>'same:password',
        ],[
            'password.required'=>'必须输入新密码',
            'password.between'=>'新密码必须在6-18位之间',
            'password_c.same'=>'确认密码必须跟新密码一致'
        ]);

        // 查询数据库和session里的用户名相同的数据
        $user = Admin::where('username',session("admin_user") -> username) -> first();
        // 判断用户输入的原密码和数据库里的密码是否相同
        if (Crypt::decrypt($user['password']) != $data['password_o']) {
            return back() -> with('error','原密码错误');
        } else {
            // 判断新密码和再次输入密码是否相同
            if ($data['password'] == $data['password_c']) {
                // 给新密码加密
                $password = Crypt::encrypt($data['password']);
                // 修改数据库用户名的密码
                if ($user -> update(['password'=>$password])) {
                    return redirect('admin/index') -> with('success','密码修改成功');
                } else {
                    return back() -> with('error','原密码错误');
                }
            }
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
