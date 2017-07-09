<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\Film;
use App\Http\Model\Admin\FilmDetail;
use DB;

class FilmController extends Controller
{
    
    /**
     * 引入电影添加页面
     * 添加电影第一步 展示表单
     * @auth 黄小康
     *
     * @return
     */
    public function create()
    {
        return view('admin.film.createFilm',['title'=>'电影信息','year'=>date('Y',time())]);
    }

    /**
     * 填写电影信息页面
     * 添加电影第二步 插入数据库
     * @auth 黄小康
     *
     * @return
     */
    public function store(Request $request)
    {
        // 验证表单提交数据的规则
        $this->validate($request, [
            'name'  => 'required',
            'price' => 'required|min:0|integer',
            '_type' => 'required',
            'area_type' => 'required',
            'year' => 'required|min:1960|max:'.date('Y',time()).'|integer',
            'film_pic' => 'required',

            'director' => 'required',
            'actor' => 'required',
            'uptime' => 'required',
            'film_detail' => 'required',

        ],[
            'name.required'  => '请输入电影名称.',
            'price.required' => '请输入电影票价.',
            'price.min' => '价格不可为负数.',
            'price.integer' => '请输入正确的票价.',
            '_type.required'  => '请输入电影所属类型.',
            'area_type.required' => '请输入电影所属地区.',
            'year.required' => '请输入电影所属年份.',
            'year.min' => '请输入正确年份.',
            'year.max' => '请输入正确年份.',
            'year.integer' => '请输入正确年份.',
            'film_pic.required' => '请选择电影封面图片',

            'director.required' => '请填入导演',
            'actor.required' => '请填入演员',
            'uptime.required' => '请填入上映时间',
            'film_detail.required' => '请填入电影简介', 
        ]);
        
        //接收上传文件
        $file = \Input::file('film_pic');

        //判断是否有效文件上传
        if( !$file -> isValid() ){
                return back() -> with('error','电影封面图片上传失败');    
        }
        //文件类型限制
        $type = ['jpg','jpeg','fig','png'];
        //获取上传文件的后缀名
        $entension = $file -> getClientOriginalExtension();
        if( !in_array($entension,$type) ){
            return back() -> with('error','请上传正确的电影封面图片');
        }
        //生成上传文件新名字
        $newName = date('YmdHis').mt_rand(1000,9999).'.'.$entension;
        //移动上传文件
        $file -> move( public_path().config("film.admin_face_path"),$newName );

        //$pic = public_path().'\uploads\uface\admin\\'.$newName;
        $pic = config("film.admin_face_path").'/'.$newName;

     //获取主表数据
        $data1 = $request -> only([
            'name',
            'price',
            '_type',
            'area_type',
            'year',
        ]);
        $data1['film_pic'] = $pic;

//      获取详情表数据
        $data2 = $request -> only([
            'name',
            'director',
            'actor',
            'uptime',
            'film_detail',
            'price',
        ]);
        $data2['film_pic'] = $pic;

        
        //开启事务
        DB::beginTransaction();

        //插入数据
        $res1 = Film::create($data1);
        $data2['id'] = $res1 -> id;
        $res2 = FilmDetail::create($data2);

        if( $res1 && $res2 ){
            DB::commit();
            return redirect('admin/film/show');
        }else{
            DB::rollBack();
            return back() -> with('error','添加失败');
        }
    }



    /**
     * 修改电影信息第一步
     * 
     * @auth 黄小康
     *
     * @return
     */
    public function show(Request $request)
    {
        $data = Film::all();

        return view('admin.film.indexFilm',['data'=>$data]);
    }

    /**
     * 修改电影信息第一步
     * 
     * @auth 黄小康
     *
     * @return
     */
    public function edit(Request $request)
    {
        $id = $request -> input('id');

        $data = Film::find($id);
        
        if($data) return view('admin.film.editFilm',['data'=>$data,'year'=>date( 'Y',time() ) ] );
        
        return redirect('admin/film/show')->with('error','此用户不存在');
    }

    public function update(Request $request)
    {   
        // 验证表单提交数据的规则
        $this->validate($request, [
            'name'  => 'required',
            'price' => 'required|min:0|integer',
            '_type' => 'required',
            'area_type' => 'required',
            'year' => 'required|min:1960|max:'.date('Y',time()).'|integer',
            'film_pic' => 'required',
        ],[
            'name.required'  => '请输入电影名称.',
            'price.required' => '请输入电影票价.',
            'price.min' => '价格不可为负数.',
            'price.integer' => '请输入正确的票价.',
            '_type.required'  => '请输入电影所属类型.',
            'area_type.required' => '请输入电影所属地区.',
            'year.required' => '请输入电影所属年份.',
            'year.min' => '请输入正确年份.',
            'year.max' => '请输入正确年份.',
            'year.integer' => '请输入正确年份.',
            'film_pic.required' => '请选择电影封面图片',
        ]);

        $id = $request -> input('id');

        $res = Film::find($id);

        if( !$res ) return redirect('admin/fiml/show') -> with('error','无此用户');

        $data = $request -> except('_token','id','film_pic');

        //接收上传文件
        $file = \Input::file('film_pic');

        //判断是否有效文件上传
        if( !$file -> isValid() ){
                return back() -> with('error','电影封面图片上传失败');    
        }
        //文件类型限制
        $type = ['jpg','jpeg','fig','png'];
        //获取上传文件的后缀名
        $entension = $file -> getClientOriginalExtension();
        if( !in_array($entension,$type) ){
            return back() -> with('error','请上传正确的电影封面图片');
        }
        //生成上传文件新名字
        $newName = date('YmdHis').mt_rand(1000,9999).'.'.$entension;
        //移动上传文件
        $file -> move( public_path().config("film.admin_face_path"),$newName );

        //$pic = public_path().'\uploads\uface\admin\\'.$newName;
        $pic = config("film.admin_face_path").'/'.$newName;

        $res -> film_pic = $pic;
        $res -> name = $data['name'];
        $res -> price = $data['price'];
        $res -> _type = $data['_type'];
        $res -> area_type = $data['area_type'];
        $res -> year = $data['year'];

        $res -> save();

        return redirect('admin/film/show') -> with('success','修改成功');
    }


    /**
     * 删除电影
     * @auth 黄小康
     *
     * @return
     */
    public function delete(Request $request)
    {
        $id = $request -> input('id');

        $res1 = Film::find($id);

        if(!$res1) return redirect('admin/film/show') -> with('error','无此用户');

        $res2 = FilmDetail::find($id);

        DB::beginTransaction();

        if( $res1 -> delete() && $res2 -> delete() ){
            DB::commit();
            return redirect('admin/film/show') -> with('success','删除成功');
        }else{
            DB::rollBack();
            return redirect('admin/film/show') -> with('error','删除失败');
        }
    }

}