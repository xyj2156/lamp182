<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersetController extends Controller
{
    /**
     * 文件上传
     */
    public function upload(Request $request)
    {
            $file = $request -> file('myfile');	//接文件

            //文件是否上传成功
            if($file->isValid()){	//判断文件是否上传成功

                // 获取上传路径数组
                $save_path = config('film.uploads');

                // 获取ajax传过来的 path
                $path_o = trim($request -> input('path'));

                // 没有传返回 ''
                if(!$path_o){
                    return '';
                }

                // 打开 config 目录里的 film.php文件自然会懂
                $path = $save_path[$path_o];

                $ext = $file->getClientOriginalExtension();    //上传文件的后缀名

                $type = $file->getClientMimeType(); //文件类型

                $fileName = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext;  //新文件名

                // 删除session里的$path_o  (目的: 让ajax提交的文件始终只有一个)
                $file_o = public_path().'/' .session($path_o);
                if(is_file($file_o)) {
                    unlink($file_o);
                }

                // 将图片上传到本地服务器
                $res = $file->move(public_path() .'/'.$path, $fileName);
                // 文件的路径
                $resPath = $path.'/'.$fileName;
                if($res){
                    // 把路径存在session里
                    session([$path_o => $resPath]);
                    return $resPath;
                }else{
                    return '';
                }
            }

    }
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/userset/userset',['title'=>'管理员信息']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
        // 验证表单提交数据的规则
        $this->validate($request, [
            'email'     =>'required|email',
            'phone'     =>'regex:/^1[34578][0-9]{9}$/',
        ],[
            'email.required'    => '必须输入邮箱。',
            'email.email'       => '请正确输入邮箱。',
            'phone.regex'       => '请输入正确手机号码。',
        ]);
        // 通过要修改的id从数据库获取这条用户的全部数据
        $user = Admin::find($id);
        // 接收用户修改后的数据
        $data = $request -> only([
            'email',
            'phone',
            'uface'
        ]);
        // 执行修改
        $res = $user->update($data);
        if (!$res) {
            return back() -> with('error','修改失败');
        } else {
            session(['admin_user' => $user]);
            return redirect('admin/index') -> with('success','修改成功');
        }
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
