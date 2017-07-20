<?php
// 2017年7月5日 23:09:33

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\Member;
use App\Http\Model\Admin\Member_detail;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    /**
     * 列出用户
     * @auth 项英杰
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
//      $data = Member::where('');
        $page = $req -> input('page',1);
        $search = $req -> input('search', '');

        $res = Member::where('username', 'like', "%{$search}%") -> paginate(10);

        return view('admin.member.index', ['title' => '前台用户查看', 'data' => $res, 'search' => $req -> all()]);
    }

    /**
     * 添加用户第一步 展示表单
     * @auth 项英杰
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.member.create', ['title' => '用户添加']);
    }

    /**
     * Store a newly created resource in storage.
     * 添加用户第二步
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @auth 项英杰
     */
    public function store(Request $request)
    {
        // 验证表单提交数据的规则
        $this->validate($request, [
            'auth'      =>'required|in:0,1,2',
            'username'  =>'regex:/^[a-zA-Z_]\w{5,17}$/',
            'password'  =>'required|between:6,18',
            'age'       =>'required|min:0|max:100|integer',
            'email'     =>'required|email',
            'sex'       =>'required|in:w,x,m',
            'phone'     =>'regex:/^1[34578][0-9]{9}$/',
        ],[
            'auth.required'     => '权限必须选择。',
            'auth.in'           => '请正确选择权限。',
            'username.regex'    => '请正确输入用户名。',
            'password.required' => '必须输入密码',
            'password.between'  => '密码长度必须在6-18位之间',
            'age.required'      => '必须输入年龄。',
            'age.min'           => '年龄太小了。',
            'age.max'           => '年龄太大了。',
            'age.integer'       => '请正确年龄。',
            'email.required'    => '必须输入邮箱。',
            'email.email'       => '请正确输入邮箱。',
            'sex.required'      => '必须选择性别。',
            'sex.in'            => '请正确选择性别。',
            'phone.regex'       => '请输入正确手机号码。',
        ]);
//        判断手机号码占用
        if(Member::where('phone',$request -> input('phone')) -> count()){
            return back() -> with('error', '手机号码已经占用,请换一个');
        }
//        判断邮箱占用
        if(Member::where('email',$request -> input('email')) -> count()){
            return back() -> with('error', '邮箱已经占用,请换一个');
        }
//        判断用户名占用
        if(Member::where('username',$request -> input('username')) -> count()){
            return back() -> with('error', '用户名已经占用,请换一个');
        }
//        分别获取数据以便添加到不同表中
        $data1 = $request -> only([
            'username',
            'password',
            'phone',
            'email'
        ]);
        $data2 = $request -> only([
            'auth',
            'age',
            'sex',
        ]);

//        生成额外需要的数据
        $data1['ltime'] = $data2['ctime'] = time();

        $data1['token'] = str_random(50);
        $data1['ip'] = $request -> ip();
        $data1['password'] = Crypt::encrypt($data1['password']);

        $data2['name'] = strtoupper(str_random(8));

//        开启事务 添加数据
        DB::beginTransaction();

        $res1 = Member::create($data1);

//        拿到主表ID 插入到副表中做主键
        $data2['id'] = $res1 -> id;
        $res2 = Member_detail::create($data2);

//        判断结果
        if ($res1 && $res2){
            DB::commit();
            return redirect('admin/user') -> with('success', '添加成功');
        }else{
            DB::rollback();
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
        $res1 = Member::find($id);
        $res2 = $res1 -> detail;
//        dd($res1, $res2);
//        判断有没有数据
        if (!$res1 || !$res2) {
            return redirect('admin/user') -> with('error', '请按套路出牌。。');
        }
//        转换成数组 方便后面使用
        $tmp = $res1 -> toArray();
        $tmp2 = array_pop($tmp);
        $data = array_merge($tmp, $tmp2);

        return view('admin.member.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     * 编辑用户第一步
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        拿数据 并判断是不是有这条数据
        $res1 = Member::find($id);
        $res2 = Member_detail::find($id);
//        没有数据可能就是来路不正
        if(!$res1 || !$res2){
            return redirect('admin/user') -> with('error', '请按套路出牌。。');
        }
//        将 查出的数据传给视图 用来解析
        return view('admin.member.edit', ['data1' => $res1, 'data2' => $res2]);
    }

    /**
     * 编辑用户第二步
     * @auth 项英杰
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 验证表单提交数据的规则
        $this->validate($request, [
            'auth'=>'required|in:0,1,2',
            'username'=>'regex:/^[a-zA-Z_]\w{5,17}/',
            'age'=>'required|min:0|max:100|integer',
            'email'=>'required|email',
            'sex'=>'required|in:w,x,m',
            'phone'=>'regex:/^1[34578][0-9]{9}$/',
        ],[
            'auth.required' => '权限必须选择。',
            'auth.in' => '请正确选择权限。',
            'username.regex'=>'请正确输入用户名。',
            'age.required'=>'必须输入年龄。',
            'age.min'=>'年龄太小了。',
            'age.max'=>'年龄太大了。',
            'age.integer'=>'请正确年龄。',
            'email.required'=>'必须输入邮箱。',
            'email.email'=>'请正确输入邮箱。',
            'sex.required'=>'必须选择性别。',
            'sex.in' => '请正确选择性别。',
            'phone.regex'=>'请正确输入手机。',
        ]);

        $res1 = Member::find($id);
        $res2 = Member_detail::find($id);
//        没有数据可能就是来路不正
        if(!$res1 || !$res2){
            return redirect('admin/user') -> with('error', '请按套路出牌。。');
        }

        DB::beginTransaction();
//        $res1 -> username = $request -> input('username','null');
//        $res1 -> phone = $request -> input('phone','null');
//        $res1 -> email = $request -> input('email','null');

//        $res2 -> auth = $request -> input('auth','0');
//        $res2 -> age = $request -> input('age', '18');
//        $res2 -> sex = $request -> input('sex', '18');
        $data2 = $request -> only(['auth','age','sex']);
        $data['status'] = 1;

        $a = $res1 -> update($request -> only(['username','phone','email']));
        $b = $res2 -> update($data2);
        if(!$a || !$b){
            DB::rollback();
            return back() -> with('error', '出了点状况，请稍候再试。');
        }
        DB::commit();
        return redirect('admin/user') -> with('success', '修改成功。');
    }

    /**
     *  删除指定用户数据
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res1 = Member::find($id);
        $res2 = Member_detail::find($id);
        if (!$res1 || !$res2) {
            return [
                'status' => 500,
                'msg' => '用户主表和附表不同步。。'
            ];
        }

        DB::beginTransaction();

        if ($res1 -> delete() && $res2 -> delete()){
            DB::commit();
            return ['status' => 0, 'msg' => '删除成功。。'];
        } else {
            DB::rollback();
            return ['status' => 500, 'msg' => '内部处理错误，请稍候再试 。。'];
        }
    }
}
