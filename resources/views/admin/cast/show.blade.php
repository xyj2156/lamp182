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
                <button type="button" class="page-header-button" onclick="location.href='{{url('admin/cast/'.$data['id'].'/edit')}}';"><span class="am-icon-paint-brush"></span> 编辑用户</button>
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
                            <td>ID</td>
                            <td>{{$data -> id}}</td>
                        </tr>
                        <tr class="even gradeC">
                            <td>姓名</td>
                            <td>{{$data -> name}}</td>
                        </tr>
                        <tr class="gradeX">
                            <td>fid</td>
                            <td>{{$data['fid']}}</td>
                        </tr>
                        <tr class="gradeX">
                            <td>性别</td>
                            <td>{{config('film.sex')[$data['sex']]}}</td>
                        </tr>
                        <tr class="even gradeC">
                            <td>创建时间</td>
                            <td>{{date('Y-m-d H:i:s', $data['ctime'])}}</td>
                        </tr>
                        <tr class="gradeC">
                            <td>更新时间</td>
                            <td>{{date('Y-m-d H:i:s', $data['utime'])}}</td>
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