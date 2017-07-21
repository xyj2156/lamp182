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
            'code',
            'remember_me'
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
        $phone_user = Member::where('phone',$data['email']) -> first();
        $email_user = Member::where('email',$data['email']) -> first();

        // 验证用户
        if($phone_user){
            // 验证密码是否正确
            if(Crypt::decrypt($phone_user['password']) == $data['password']){
                // 获取到当前登录成功的时间
                $phone_user -> ltime = time();
                // 执行跟新数据
                $phone_user -> save();
                // 将用户信息添加到session中
                session(['home_user' => $phone_user]);
                // 记住我 把用户登录信息存入cookie
                if($data['remember_me'] == 'on'){
                    \Cookie::queue('userinfo',$data,7*24*60);
                } else {
                    \Cookie::queue('userinfo',null,-1);
                }
                if (session('url')) {
                    return redirect(session('url')) -> with('success','登录成功');
                }
                return redirect('/') -> with('success','登录成功...');
            }else{
                return back() -> with('error','密码错误..');
            }
        }
        if($email_user){
            // 验证邮箱是否激活
            if ($email_user['status'] !== 1)
                return back() -> with('邮箱未激活');
            // 验证密码是否正确
            if(Crypt::decrypt($email_user['password']) == $data['password']){
                // 获取到当前登录成功的时间
                $email_user -> ltime = time();
                // 执行跟新数据
                $email_user -> save();
                // 将用户信息添加到session中
                session(['home_user' => $email_user]);

                // 记住我 判断是否把用户登录信息存入cookie
                if($data['remember_me'] == 'on'){
                    \Cookie::queue('userinfo',$data,7*24*60);
                } else {
                    \Cookie::queue('userinfo',null,-1);
                }
                // 判断有没有来源地址 (购票登录)
                $url = session('url');
                if ($url) {
                    session(['url' => null]);
                    return redirect::intended($url) -> with('success','登录成功');
                }
                return redirect('/') -> with('success','登录成功...');
            }else{
                return back() -> with('error','密码错误..');
            }
        }
        return back() -> with('error','没有这个用户');
    }

    /**
     * 安全退出
     */
    public function logout()
    {
        session(['home_user'=>null]);
        return redirect('login');
    }
}
