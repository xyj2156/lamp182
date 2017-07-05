@extends('admin.layout.index')

@section('content')
<<<<<<< HEAD
    <div class="container-fluid am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 后台首页 <small>江洋八子</small></div>
                <p class="page-header-description">简单组合，干出不简单的事情。。。。。</p>
            </div>
        </div>
    </div>
    <div class="row-content am-cf">
        <div class="widget am-cf">
            <div class="widget-body  widget-body-lg am-fr">
                <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                    <thead>
                    <tr>
                        <th  colspan="2">系统信息</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="gradeX">
                        <td>操作系统：</td>
                        <td>{{PHP_OS}}</td>
                    </tr>
                    <tr class="even gradeC">
                        <td>运行环境：</td>
                        <td>{{$_SERVER ['SERVER_SOFTWARE']}},  {{$_SERVER ['GATEWAY_INTERFACE']}}</td>
                    </tr>
                    <tr class="even gradeC">
                        <td>php运行方式：</td>
                        <td>{{ strtoupper(php_sapi_name()) }}</td>
                    </tr>
                    <tr class="gradeX">
                        <td>开发者：</td>
                        <td>项英杰、杨鹏亮、崔波波、黄大康</td>
                    </tr>
                    <tr class="even gradeC">
                        <td>上传附件限制：</td>
                        <td>{{ini_get('upload_max_filesize')}}</td>
                    </tr>
                    <tr class="even gradeC">
                        <td>服务端地址：</td>
                        <td>{{$_SERVER['SERVER_ADDR']}}</td>
                    </tr>

                    <tr class="even gradeC">
                        <td>本地IP：</td>
                        <td>{{$_SERVER['REMOTE_ADDR']}}</td>
                    </tr>
                    <!-- more data -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
