<?php
/**
 * 2017年7月9日 14:00:14
 * author 项英杰
 */

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\Banner;
use App\Http\Model\Admin\Webconfig;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class WebConfigController extends Controller
{
    /**
     *  展示网站配置项 以供修改
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $data = Webconfig::select('title','email', 'logo', 'keywords', 'description','copyright', 'icp') -> find(1);
        $title = '网站配置修改';
        return view('admin.config.edit', compact('data', 'title'));
    }

    /** 更新数据到数据库
     * @param Request $req
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postIndex(Request $req)
    {
        $config = Webconfig::find(1);


        if( $config -> update($req -> only(['title', 'email', 'logo', 'keywords', 'description', 'copyright', 'icp']) )) {
//            向配置文件中更新配置项
            file_put_contents(config_path().'/webconf.php', '<?php return '.var_export($config->toArray(), true).';');
            return redirect('admin/config')->with('success', '修改成功');
        } else
            return back() -> with('error', '修改失败，请稍候重试。');
    }

    /** 轮播图管理 轮播图列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getBanner()
    {
        $data = Banner::orderBy('order', 'asc') -> get();
        $title = '轮播图管理';
        return view('admin.config.banner', compact('data', 'title'));
    }

    /**
     * 添加轮播图 第一步
     */
    public function getCreate()
    {
        return view('admin.config.bannercreate', ['title' => '添加轮播图']);
    }

    /** 添加轮播图 第二步
     * @param Request $req
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postBanner(Request $req)
    {
        $this -> validate($req, [
            'title' => 'required',
            'url' => 'required',
        ],[
            'title.required' => '请填写标题',
            'url.required' => '请填写连接地址',
        ]);
        $data = $req -> only([
            'title',
            'pic',
            'url',
        ]);

        if(Banner::create($data)){
//            添加轮播图之后删除记录在 session 中的图片记录，防止下次上传图片后删除这个图片文件
            session(['banner_path' => null]);
//            读取文件配置写到 redis 中
            $this -> bannerThumb();
            return redirect('admin/config/banner') -> with('success', '添加成功。');
        } else {
            return back() -> with('error', '添加失败。');
        }
    }

    /** 编辑对应的轮播图 第一步
     * @param Request $req
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getEdit(Request $req)
    {
        $id = $req -> input('id');
        if(!$id)
            return back() -> with('error', '请按套路出牌。');
        $data = Banner::find($id);
        $title = '编辑轮播图 '.$data -> title;
        return view('admin.config.banneredit', compact('data', 'title'));
    }

    /** 编辑轮播图第二步
     * @param Request $req
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(Request $req)
    {
//        自动表单验证
        $this -> validate($req, [
            'title' => 'required',
            'url' => 'required',
        ],[
            'title.required' => '请填写标题',
            'url.required' => '请填写连接地址',
        ]);
//        获取ID
        $id = $req -> input('id');
//        判断有没有ID
        if(!$id)
            return back() -> with('error', '请按套路出牌。');
        $data = $req -> only([
            'title',
            'url',
            'pic'
        ]);
        $banner = Banner::find($id);
//        判断有没有模型
        if(!$banner)
            return back() -> with('error', '请按套路出牌。');
//        记录旧文件位置
        $file = public_path().$banner -> pic;
//        判断缩略图文件是不是应该删除
        $isUnlink = $banner -> pic != $data['pic'];
//        更新数据库
        if($banner -> update($data)){
//            清除ajax在session 中的记录
            session(['banner_path' => null]);
//            删除旧文件
            if($isUnlink && is_file($file)) unlink($file);
//            生成配置文件
            $this -> bannerThumb();
            return redirect('admin/config/banner') -> with('success', '修改成功。');
        } else
            return back() -> with('error', '修改失败请稍候重试。');
    }

    /** 执行删除轮播图
     * @param Request $req
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public function postDelete(Request $req)
    {
//        获取传过来的id
        $id = $req -> input('id');
//        如果没有ID 直接返回
        if(!$id) return back() -> with('error', '请按照套路出牌');
//        获取模型
        $banner = Banner::find($id);
//        判断有没有模型
        if(!$banner)
            return back() -> with('error', '请按套路出牌。');
//        获取缩略图文件
        $file = public_path().$banner -> pic;
//        删除数据
        if($banner -> delete()){
//            删除文件
            if(is_file($file)) unlink($file);
//            生成配置文件
            $this -> bannerThumb();
            return [
                'status' => 0,
                'msg' => '删除成功。'
            ];
        } else
            return [
                'status' => 404,
                'msg' => '删除失败。'
            ];

    }

    /** 轮播图排序
     * @param Request $req
     * @return array
     */
    public function getOrder(Request $req)
    {
//        获取传过来的参数
        $id = $req -> input('id');
        $order = $req -> input('order');
//        判断参数是不是符合要求
        if(!$id || !$order || $order < 0 || $order > 255) return ['status' => 403, 'msg' => '请按套路出牌。'];
//        获取模型
        $banner = Banner::find($id);
        if(!$banner) return ['status' => 403, 'msg' => '请按套路出牌。'];
//        执行排序
        $banner -> order = $order;
        if($banner -> update()){
//            生成配置文件
            $this -> bannerThumb();
            return [
                'status' => 0,
                'msg' => '排序成功。'
            ];
        } else
            return [
                'status' => 403,
                'msg' => '排序出问题了，请保证值在 0- 255 之间。'
            ];
    }

    public function bannerThumb()
    {
        $banner = Banner::select('title', 'pic', 'url') -> orderBy('order', 'asc') -> get();
        $str = var_export($banner -> toArray(), true);
        file_put_contents(config_path().'/banner.php',"<?php \n return {$str};");
    }
}
