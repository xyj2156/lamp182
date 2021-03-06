<?php

namespace App\Http\Controllers\Admin;
 
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\Admin\Admin;

require_once app_path().'/Org/code/Code.class.php';
use App\Org\code\Code;

use Illuminate\Support\Facades\Crypt;


class LoginController extends Controller
{
    
    /**
     *返回后台登录页面
     */
    public function login()
    {
        return view('admin.login.login', ['title' => '后台登陆']);
    }

    /**
     * 验证码
     */
    public function code($id)
    {
        $code = new Code();
        $code -> num(1);
        $code->make();
    }

    /**
     * 处理后台登录信息
     */
    public function dologin(Request $request)
    {
         // 用户提交的信息
         $data = $request -> except('_token');
         // 闪存数据
         $request -> flash();
         // 验证表单提交数据的规则
         $this->validate($request, [
            'username'=>'required|between:6,18',
            'password'=>'required|between:6,18'
         ],[
            'username.required'=>'必须输入用户名',
            'username.between'=>'用户名长度必须在6-18位之间',
            'password.required'=>'必须输入密码',
            'password.between'=>'密码长度必须在6-18位之间'
         ]);

         // 验证码是否正确
         if(strtoupper($data['code']) !== session('code')){
             return back() -> with('error','验证码错误');
         }
         // 查询数据库是否有这个用户
         $user = Admin::where('username','=',$data['username']) -> first();

         if (!$user) {
             return back() -> with('error','用户名不存在');
         } else {
             if (Crypt::decrypt($user['password']) !==  $data['password']) {
                return back() -> with('error','账号或密码错误');
             }
         }
         // 获取到当前登录成功的时间
         $user -> ltime = time();
         // 执行跟新数据
         $user  -> save();

         // 将用户信息添加到session中
         session(['admin_user' => $user]);
         return redirect('admin/index') -> with('success','登陆成功');
       
    }

    /**
     *后台主页
     */
    public function index()
    {
        return view('admin.index.index');
    }

    /**
     * 后台退出登录
     */
    public function logout()
    {
        session(['admin_user'=>null]);
        return redirect('admin/login');
    }
}
