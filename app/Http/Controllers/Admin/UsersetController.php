<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Storage;
use App\Http\Controllers\Controller;

class UsersetController extends Controller
{
    /**
     * 文件上传
     */
    public function upload(Request $request)
    {
            $file = Input::file('myfile');	//接文件

            //文件是否上传成功
            if($file->isValid()){	//判断文件是否上传成功
                $originalName = $file->getClientOriginalName(); //源文件名

                $ext = $file->getClientOriginalExtension();    //上传文件的后缀名

                $type = $file->getClientMimeType(); //文件类型

                $realPath = $file->getRealPath();   //临时文件的绝对路径

                $fileName = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext;  //新文件名

                // 将图片上传到本地服务器
                $path = $file->move(public_path() .'/'. config("film.admin_face_path"), $fileName);

                // 返回文件的上传路径
                $filepath = config("film.admin_face_path") .'/'. $fileName;
                return $filepath;
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
            'username'  =>'regex:/^[a-zA-Z_]\w{5,17}$/',
            'email'     =>'required|email',
            'phone'     =>'regex:/^1[34578][0-9]{9}$/',
        ],[
            'username.regex'    => '请正确输入用户名。',
            'email.required'    => '必须输入邮箱。',
            'email.email'       => '请正确输入邮箱。',
            'phone.regex'       => '请输入正确手机号码。',
        ]);
        // 通过要修改的id从数据库获取这条用户的全部数据
        $user = Admin::find($id);
        // 接收用户修改后的数据
        $data = $request -> only([
            'username',
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
