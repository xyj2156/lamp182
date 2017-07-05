@extends('admin.layout.index')

@section('content')
    {{--标头--}}
    <div class="container-fluid am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 表格 <small>Amaze UI</small></div>
                <p class="page-header-description">Amaze UI 有许多不同的表格可用。</p>
            </div>
            <div class="am-u-lg-3 tpl-index-settings-button">
                <button type="button" class="page-header-button"><span class="am-icon-paint-brush"></span> 设置</button>
            </div>
        </div>
    </div>
    <div class="row-content am-cf">
    {{--显示表格--}}
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-fl">用户列表</div>
                </div>
                <div class="widget-body  widget-body-lg am-fr">

                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>用户名</th>
                                <th>最后一次登陆时间</th>
                                <th>注册IP</th>
                                <th>token</th>
                                <th>phone</th>
                                <th>email</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $k => $v)
                            <tr class="gradeX">
                                <td>{{$v['id']}}</td>
                                <td>{{$v['username']}}</td>
                                <td>{{date('Y-m-d H:i:s', $v['ltime'])}}</td>
                                <td>{{$v['ip']}}</td>
                                <td>{{$v['token']}}</td>
                                <td>{{$v['phone']}}</td>
                                <td>{{$v['email']}}</td>
                                <td>
                                    <div class="tpl-table-black-operation">
                                        <a href="javascript:;">
                                            <i class="am-icon-pencil"></i> 编辑
                                        </a>
                                        <a href="javascript:;" class="tpl-table-black-operation-del">
                                            <i class="am-icon-trash"></i> 删除
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection