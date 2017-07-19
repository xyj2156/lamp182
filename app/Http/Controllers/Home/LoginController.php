<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Admin\Member;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * 加载登录页面
     */
    public function login()
    {
        return view('home.login.login',['title' => '登录']);
    }

    /**
     * 处理提交的数据
     */
    public function dologin(Request $request)
    {
        // 接收提交的信息
        $data = $request -> only([
            'email',
            'password',
            'code'
        ]);
        // 闪存数据
        $request -> flash();

        // 验证码是否正确
        if(strtoupper($data['code']) !== session('code')){
            return back() -> with('error','验证码错误');
        }
        // 验证邮箱或者手机号
        if (!trim($data['email'])) {
            return back() -> with('error','账号不能为空');
        } else {
            if (!preg_match('/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i',$data['email']) && !preg_match('/^1[34578][0-9]{9}$/',$data['email'])){
                return back() -> with('error','请输入正确的账号');
            }
        }
        // 验证表单提交数据的规则
        $this->validate($request, [
            'password'=>'required|between:6,18'
        ],[
            'password.required'=>'必须输入密码',
            'password.between'=>'密码长度必须在6-18位之间'
        ]);

        // 根据表单name值 email 来查出这条数据
        $user = Member::where('email',$data['email']) -> orwhere('phone',$data['email']) -> first();
        // 验证用户
        if (!$user) {
            return back() -> with('error','没有这个用户名');
        } else {
            // 验证密码是否正确
            if (Crypt::decrypt($user['password']) !== $data['password']) {
                return back() -> with('error','账号或密码错误');
            };
        }

        // 获取到当前登录成功的时间
        $user -> ltime = time();
        // 执行跟新数据
        $user  -> update();

        // 将用户信息添加到session中
        session(['home_user' => $user]);
        return redirect('/') -> with('success', '登录成功...');
    }
}
