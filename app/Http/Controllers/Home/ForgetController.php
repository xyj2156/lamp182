<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\RegController;
use App\Http\Model\Admin\member; 
use Illuminate\Support\Facades\Crypt;
use DB;


class ForgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function forget()
    {
        return view('home.forget.forget',['title'=>'忘记密码']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function doforget(Request $request)
    {
        // 接收需要重新设置密码的手机号
        $data = $request -> except('_token');
        $phone = $data['phone'];
        $phone_code = $data['phone_code'];
        // 检测该手机号注册过没有
        $res = Member::where('phone',$phone) -> first();
       
        if($res && ($phone_code == session('phone_code'))){
            return view('home.newpass.newpass',['title'=>'设置新密码','phone' => $phone]);
        }else{
            return back() -> with('error','验证码错误 或者 该手机号没有注册过..');
        }
    }

    /**
     * 接收数据,设置新密码
     */
    public function donewpass(Request $request)
    {
        // 验长度证密码
        $this->validate($request, [
            'password'=>'required|between:6,18'
        ],[
            'password.required'=>'必须输入密码',
            'password.between'=>'密码长度必须在6-18位之间'
        ]);

        // 接收忘记密码的手机号和要设置的密码
        $data = $request -> except('_token');
        $phone = $data['phone'];
        $password = $data['password'];
        //dd($data);
        if($data['password'] != $data['repassword']){
            return back() -> with('error','两次密码不一致');
        }else{
            $password = Crypt::encrypt($password);

            //重新设置新密码
            $res = Member::where('phone',$phone) -> update(['password'=>$password]);

            if($res){
                return redirect('/login') -> with('success','设置成功');
            }else{
                return back() -> with('error','设置新密码失败..');
            }
        }
    }

    public function phone_code(Request $request)
    {
        $phone = $request -> input('phone');
        $res = self::send_phone($phone);
    }

    public function send_phone($phone)
    {
        $phone_code = rand(1,9);
        session(['phone_code'=>$phone_code]);
        $url = 'http://106.ihuyi.com/webservice/sms.php?method=Submit&account=C79862553&password=92679c0200d732e45a135bdac311d81a&format=json&mobile='.$phone.'&content=您的验证码是：'.$phone_code.'。请不要把验证码泄露给其他人。';
        $res = HttpController::gets($url);
        return $res;
    }

    
}
