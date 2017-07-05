<?php

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
//        $data = Member::where('');
        $page = $req -> input('page',1);
        $search = $req -> input('search', '');

        $res = Member::where('username', 'like', "%{$search}%") -> paginate(10);

        return view('admin.member.index', ['title' => '前台用户查看', 'data' => $res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.member.create', ['title' => '用户添加']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

        $data1['ltime'] = $data2['ctime'] = time();

        $data1['token'] = str_random(50);
        $data1['ip'] = $request -> ip();
        $data1['password'] = Crypt::encrypt($data1['password']);

        $data2['name'] = strtoupper(str_random(8));

//        开启事务
        DB::beginTransaction();

        $res1 = Member::create($data1);

        $data2['id'] = $res1 -> id;
        $res2 = Member_detail::create($data2);

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
