<?php

/**
 * 2017年7月9日 18:46:48 项英杰 全文修正
 */

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\Cast;
use App\Http\Model\Admin\Film_type;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\Film;
use App\Http\Model\Admin\FilmDetail;
use DB;

class FilmController extends Controller
{

    public function index(Request $req)
    {
        $search = $req -> input('search');
        $data = Film::where('name','like', "%{$search}%") -> paginate(10);
        $title = '电影列表';
        $search = $req -> all();
        $type = Film_type::lists('name','id') -> all();
        return view('admin.film.indexFilm', compact('data', 'title', 'search', 'type'));
    }


    /**
     * 引入电影添加页面
     * 添加电影第一步 展示表单
     * @auth 黄小康
     *
     * @return
     */
    public function create()
    {
        $title = '添加电影';
//        处理电影分类
        $type = Film_type::all();
        $area_type = [];
        $_type = [];
        $year = [];

        foreach ($type as $v){
            switch ($v -> pid){
                case 1:
                    $area_type[] = $v;
                    break;
                case 2:
                    $year[] = $v;
                    break;
                case 3:
                    $_type[] = $v;
                    break;
            }
        }

        return view('admin.film.createFilm', compact('title', 'area_type', '_type', 'year'));

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
            'year' => 'required|integer',
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
            'year.integer' => '请输入正确年份.',
            'film_pic.required' => '请选择电影封面图片',
            'director.required' => '请填入导演',
            'actor.required' => '请填入演员',
            'uptime.required' => '请填入上映时间',
            'film_detail.required' => '请填入电影简介', 
        ]);
        
//        获取主表数据
        $data1 = $request -> only([
            'name',
            'price',
            '_type',
            'area_type',
            'year',
            'film_pic'
        ]);


//      获取详情表数据
        $data2 = $request -> only([
            'director',
            'actor',
            'uptime',
            'film_detail',
            'film_detail_full',
            'time',
            'keywords',
        ]);

        $data2['uptime'] = strtotime($data2['uptime']);

        //开启事务
        DB::beginTransaction();

        //插入数据
        $res1 = Film::create($data1);
        $data2['id'] = $res1 -> id;
        $res2 = FilmDetail::create($data2);

        if( $res1 && $res2 ){
            session(['film_path' => null]);
            DB::commit();
            return redirect('admin/film/') -> with('success', '添加成功');
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

    public function show($id)
    {
        //根据ID取出电影表数据
        $data = Film::find($id);
        if(!$data) return back() -> with('error', '请按照套路出牌。');
        $filmDetail = $data -> detail;
        if(!$filmDetail) return back() -> with('error', '请按照套路出牌。');
        //取出电影详情表数据
        $data['director'] = $filmDetail['director'];
        $data['time'] = $filmDetail['time'];
        $data['uptime'] = $filmDetail['uptime'];
        $data['film_detail'] = $filmDetail['film_detail'];
        //取出对应的演员
        $actor = explode(',',$filmDetail['actor']);
        $actor = Cast::select('name')->whereIn('id',$actor)->get();
        $data['actor'] = $actor;
        //取出对应的类型名
        $types = array($data['_type'],$data['area_type'],$data['year']);
        $types = Film_type::select('name','pid')->whereIn('id',$types)->get();
        foreach($types as $k => $v){
            if($v['pid'] == 1){
                $data['area_type'] = $v['name'];
            }elseif($v['pid'] == 2){
                $data['year'] = $v['name'];
            }else{
                $data['_type'] = $v['name'];
            }
        }

        return view('admin.film.detailFilm',['title' => '电影详情 -- '.$data -> name,'data'=>$data]);
    }

    /**
     * 修改电影信息第一步
     * 
     * @auth 黄小康
     *
     * @return
     */

    public function edit($id)
    {

        $data = Film::find($id);
        if(!$data) return back() -> with('error', '电影不存在。');
        $data2 = FilmDetail::find($id);
        if(!$data2) return back() -> with('error', '电影数据库出问题了。');
        $type = Film_type::all();
        $title = '修改电影 -- '.$data -> name;
        $area_type = [];
        $_type = [];
        $year = [];

        foreach ($type as $v){
            switch ($v -> pid){
                case 1:
                    $area_type[] = $v;
                    break;
                case 2:
                    $year[] = $v;
                    break;
                case 3:
                    $_type[] = $v;
                    break;
            }
        }

        return view('admin.film.editFilm', compact('data', 'data2', 'title', '_type', 'year', 'area_type'));
    }

    public function update(Request $request, $id)
    {
        // 验证表单提交数据的规则
        $this->validate($request, [
            'name'  => 'required',
            'price' => 'required|numeric',
            '_type' => 'required',
            'director' => 'required',
            'area_type' => 'required',
            'year' => 'required',
            'film_pic' => 'required',
        ],[
            'name.required'  => '请输入电影名称.',
            'price.required' => '请输入电影票价.',
            'price.numeric' => '请输入正确的票价.',
            '_type.required'  => '请输入电影所属类型.',
            'director.required'  => '请输入导演.',
            'area_type.required' => '请输入电影所属地区.',
            'year.required' => '请输入电影所属年份.',
            'film_pic.required' => '请选择电影封面图片',
        ]);

        $res = Film::find($id);

        if( !$res ) return back() -> with('error','无此电影。');
        $res2 = FilmDetail::find($id);
        if( !$res2 ) return back() -> with('error','无此电影。');

        $data = $request -> only([
            'name',
            'film_pic',
            'price',
            '_type',
            'area_type',
            'year'
        ]);
        $data2 = $request -> only([
            'director',
            'actor',
            'uptime',
            'film_detail',
            'film_detail_full',
            'time',
            'keywords',
        ]);

        $data2['uptime'] = strtotime($data2['uptime']);

        $data['film_pic'] = isset($data['film_pic']) ? $data['film_pic'] : $res -> film_pic;
//        记录一下旧文件
        $file = public_path().$res -> film_pic;
        $isUnlink = $res -> film_pic != $data['film_pic'];

        $res -> film_pic = $data['film_pic'];

        $res -> name = $data['name'];
        $res -> price = $data['price'];
        $res -> _type = $data['_type'];
        $res -> area_type = $data['area_type'];
        $res -> year = $data['year'];


        if($res -> update($data) && $res2 -> update($data2)){
            session(['film_path' => null]);
            if($isUnlink && is_file($file)) unlink($file);
            return redirect('admin/film') -> with('success','修改成功');
        } else {
            return back() -> with('error', '修改失败请稍候重试。');
        }
    }


    /**
     * 删除电影
     * @auth 黄小康
     *
     * @return
     */

    public function destroy($id)
    {
        $res1 = Film::find($id);
        $res2 = FilmDetail::find($id);
        if (!$res1 || !$res2) {
            return [
                'status' => 500,
                'msg' => '请按套路出牌。。'
            ];
        }

        DB::beginTransaction();
        $file = public_path().$res1 -> film_pic;

        if ($res1 -> delete() && $res2 -> delete()){
            if(is_file($file)) unlink($file);
            DB::commit();
            return ['status' => 0, 'msg' => '删除成功。。'];
        } else {
            DB::rollback();
            return ['status' => 500, 'msg' => '内部处理错误，请稍候再试 。。'];

        }
    }

    public function film($name)
    {
        $res = Film::where('name', 'like', "%{$name}%") -> select('id', 'name') -> take(5) -> get();
        return $res -> toArray();
    }

    public function search(Request $request)
    {
        echo '123';
    }

}