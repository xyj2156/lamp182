<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\Member;
use App\Http\Controllers\Home\HttpController;
use Illuminate\Support\Facades\Crypt;
use DB;
use Mail;

class RegController extends Controller
{
	/**
	  * 前台注册页面
	  */ 
    public function reg()
    {
        return view('home.reg.reg',['title' => '注册']);
    }
    /**
     * 发送手机验证码
     */
    public function phone_code(Request $request)
    {
    	$phone = $request -> input('phone');
    	//echo $phone;
    	$res = self::send_phone($phone);
    	echo $res;

    }

    public function send_phone($phone)
    {
    	$phone_code = rand(1,9);
    	session(['phone_code'=>$phone_code]);
    	$url = 'http://106.ihuyi.com/webservice/sms.php?method=Submit&account=C79862553&password=92679c0200d732e45a135bdac311d81a&format=json&mobile='.$phone.'&content=您的验证码是：'.$phone_code.'。请不要把验证码泄露给其他人。';
    	$res = HttpController::gets($url);
    	return $res;
    }

    /**
     * 处理前台手机注册信息
     */
    public function doreg(Request $request)
    {
        $this->validate($request, [
            'password'=>'required|between:6,18'
        ],[
            'password.required'=>'必须输入密码',
            'password.between'=>'密码长度必须在6-18位之间'
        ]);
    	// 验证手机验证码
    	$phone_code = $request -> only('phone_code');
    	if($phone_code['phone_code'] != session('phone_code')){
    		session(['phone_code'=>null]);
    		return back() -> with('error','验证码不正确..');
    	}else{
    		// 接收手机号,密码
    		$data = $request -> except('_token','phone_code');
	    	$phone = $data['phone'];
            $data['password']= Crypt::encrypt($data['password']);
	    	// 检测该手机号注册过没有
	    	$res = Member::where('phone',$phone)->first(); 

	    	if($res){
	    		session(['phone_code'=>null]);
	    		return back() -> with('error','已经注册过了..');
	    		
	    	}else{
	    		$re = Member::insert($data);
	    		if($re){
                    //$res['status'] = 1;
                    /*$res -> save();
                    dd($res);*/
	    			session(['phone_code'=>null]);
	    			return redirect('/login');
	    			
	    		}else{
					session(['phone_code'=>null]);
	    			return back() -> with('error','注册失败');
	    			
	    		}
	    	}
    	}
    	
    	
    }

    /**
     * 邮箱注册
     */
    public function doemail(Request $request)
    {
    	// 接收提交的数据
    	$data = $request -> except('_token','repassword','refer','vcode');
    	$vcode = $request -> only('vcode');
    	
        $request -> flash();
        // 验证密码
        $this->validate($request, [
            'repassword'=>'required|between:6,18',
            'password'=>'required|between:6,18'
        ],[
            'repassword.required'=>'必须确认密码',
            'repassword.between'=>'确认密码长度必须在6-18位之间',
            'password.required'=>'必须输入密码',
            'password.between'=>'密码长度必须在6-18位之间'
        ]);

    	
    	
    	$repassword = $request -> only('repassword');
    	$data['password'] = Crypt::encrypt($data['password']);
    	$data['ltime'] = time();
    	$data['token'] = str_random(50);
     	//dd($data['password'],$repassword['repassword']);

    	//检测验证码
    	if($vcode['vcode'] != strtolower(session('code'))){
    		return back() -> with('error','验证码错误..');
    	}
    	// 检测该邮箱注册过没有
    	$res = Member::where('email',$data['email']) -> first();
    	if($res){
    		return back() -> with('error','该邮箱已经注册过..');
    	}

    	if(Crypt::decrypt($data['password']) != $repassword['repassword']){
    		return back() -> with('error','两次密码不一致..');
    	}else{
    		//$res = Member::insert($data['email'],$data['password']);
    		$id = DB::table('members') -> insertGetId($data);
    		
    		if($id){
    			//发送邮件
    			self::send_email($data['email'],$id,$data['token']);
    			return redirect('login') -> with('success','注册成功,请去邮箱激活账号..');
    		}
    	}
    }

    public static function send_email($email,$id,$token)
    {
    	Mail::send('home.email.index', ['email'=>$email,'id' => $id,'token'=> $token], function ($m) use ($email){
            $m->to($email)->subject('注册邮件!');
        });
    }
    // 激活邮箱
    public static function jihuo(Request $request)
    {
    	// 修改status字段以区分激活没有
    	$id = $request -> only('id');
    	$token = $request -> only('token');

    	// 通过token检测是否合法路径来的
    	$token['token'] = Member::where('id',$id) -> select('token') -> first();

    	if($token['token'] != $token['token']){
    		return redirect('/reg');
    	}else{ 
    		
    		$res = Member::where('id',$id) -> first();
    		$res -> token = str_random(50);
    		$res -> status = 1;
    		$res -> save();
    		return redirect('login') -> with('success','激活成功');
    	}
    	
    }
}
