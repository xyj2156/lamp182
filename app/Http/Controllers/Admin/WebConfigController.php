<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\Banner;
use App\Http\Model\Admin\Webconfig;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WebConfigController extends Controller
{
    /**
     *  展示网站配置项 以供修改
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $data = Webconfig::select('title','email', 'logo', 'keywords', 'description') -> find(1);
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

        dd($config -> toArray());

        if($config -> update($req -> only(['title', 'email'])))
            return redirect('admin/config') -> with('success', '修改成功');
        else
            return back() -> with('error', '修改失败，请稍候重试。');
    }

    public function getBanner()
    {
        $data = Banner::orderBy('order', 'asc') -> get();
        $title = '轮播图修改';
        return view('admin.config.banner', compact('data', 'title'));
    }

    /**
     * 添加轮播图
     */
    public function getCreate()
    {
        return view('admin.config.bannercreate', ['title' => '添加轮播图']);
    }

    public function postBanner(Request $req)
    {
        $data = $req -> only([
            'title',
            'pic',
            'url',
        ]);

        if(Banner::create($data)){
            return redirect('admin/config/banner') -> with('success', '添加成功。');
        } else {
            return back() -> with('error', '添加失败。');
        }
    }

    public function getEdit(Request $req)
    {

    }
}
