<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\Member;
use Illuminate\Support\Facades\Crypt;
use App\Org\phoneHTTP\phoneHTTP;

class SecureController extends Controller
{
 
 //显示修改密码页面
 public function updatePassword()
 {
    return view('home.personage.updatepassword',['title'=>'修改密码']);
 }

 // 修改密码
 public function passwordAjax(Request $request)
 {
    //获取用户信息
    $member = session('home_user');

    //获取密码
    $password = $request -> input('password');

    //判断密码是否对应
    if( Crypt::decrypt($member->password) !== $password ) return $data = ['status'=>500,'response'=>'密码错误'];
    
    return $data = ['status'=>200,'response'=>'密码正确'];

 }

//发送手机短信
 public function phoneAjax(Request $request)
 {
    $phone = session('home_user')['phone'];

    $res = self::phoneto($phone);

    if($res) return $data = ['status'=>200,'response'=>'发送短信成功'];
 }
//发送手机短信
public static function phoneto($phone)
{
        $code = rand(1000,9999);
        session(['phoneCODE'=>$code]);
        $str = "http://106.ihuyi.com/webservice/sms.php?method=Submit&account=C90648994&password=d2c00d10958cbf6e1b2a4df45aef79e5&mobile=".$phone."&content=您的验证码是：".$code."。请不要把验证码泄露给其他人。";
        $res = phoneHTTP::get($str);
        return $res;
}

    //密码进行修改
    public function updateValidate(Request $request)
    {
        //接收验证码
        $phoneCODE = $request -> input('phoneCODE');
        if( $phoneCODE != session('phoneCODE') ) return back() -> with('error','验证码错误'); 

        //接收新密码
        $npassword = $request -> input('npassword');
        //接收用户信息
        $member = session('home_user');

        //修改密码
        $res = Member::where('id',$member->id)->update(['password'=>Crypt::encrypt($npassword)]);

        //注销用户
        session(['home_user' => null]);

        return view('home.personage.successpassword');

    }


}
