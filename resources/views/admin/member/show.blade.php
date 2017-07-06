@extends('admin.layout.index')

@section('content')
    {{--标头--}}
    <div class="container-fluid am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 用户管理 <small>江洋八子</small></div>
                <p class="page-header-description">简单组合。。。干不简单的事情。。。</p>
            </div>
            <div class="am-u-lg-3 tpl-index-settings-button">
                <button type="button" class="page-header-button" onclick="location.href='{{url('admin/user/'.$data['id'].'/edit')}}';"><span class="am-icon-paint-brush"></span> 编辑用户</button>
            </div>
        </div>
    </div>
    <div class="row-content am-cf">
        <div class="widget am-cf">
            <div class="widget-head am-cf">
                <div class="widget-title am-fl">用户详情 </div>
            </div>
            <div class="widget-body  widget-body-lg am-fr">
                <table width="100%" class="am-table am-table-compact tpl-table-black " id="example-r">
                    <tbody>
                        <tr class="gradeX">
                            <td>会员级别</td>
                            <td>{{config('film.auth')[$data['auth']]}}</td>
                        </tr>
                        <tr class="even gradeC">
                            <td>昵称</td>
                            <td>{{$data['name']}}</td>
                        </tr>
                        <tr class="gradeX">
                            <td>登陆名</td>
                            <td>{{$data['username']}}</td>
                        </tr>
                        <tr class="even gradeC">
                            <td>年龄</td>
                            <td>{{$data['age']}}</td>
                        </tr>
                        <tr class="gradeX">
                            <td>性别</td>
                            <td>{{config('film.sex')[$data['sex']]}}</td>
                        </tr>
                        <tr class="even gradeC">
                            <td>手机</td>
                            <td>{{$data['phone']}}</td>
                        </tr>
                        <tr class="gradeC">
                            <td>邮箱</td>
                            <td>{{$data['email']}}</td>
                        </tr>
                        <tr class="even gradeC">
                            <td>注册时间</td>
                            <td>{{date('Y-m-d H:i:s', $data['ctime'])}}</td>
                        </tr>
                        <tr class="gradeC">
                            <td>注册IP</td>
                            <td>{{$data['ip']}}</td>
                        </tr>
                        <tr class="gradeC">
                            <td>最后一次登陆时间</td>
                            <td>{{date('Y-m-d H:i:s', $data['ltime'])}}</td>
                        </tr>
                        <tr class="even gradeC">
                            <td>余额</td>
                            <td><a style="font-weight: bold">{{$data['money']}}</a> 元</td>
                        </tr>
                        <tr class="even gradeC">
                            <td>查询随机码</td>
                            <td>{{str_random(50)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection