@extends('admin.layout.index')

@section('content')
    {{--标头--}}
    <div class="container-fluid am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 用户管理 <small>江洋八子</small></div>
                <p class="page-header-description">简单组合。。。干不简单的事情。。。</p>
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
                                <th>排序</th>
                                <th>ID</th>
                                <th>链接名</th>
                                <th>链接标题</th>
                                <th>链接地址</th>
                                <th>缩略图</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($data as $k => $v)
                            <tr class="gradeX" >
                                <td>
                                    <input  id='order_1' style="width:30px" type="text" onchange="chang(this,'{{$v -> id}}')" value="{{$v ->order}}">
                                </td>
                                <td>{{$v -> id}}</td>
                                <td>{{$v['linkname']}}</td>
                                <td>{{$v['linktitle']}}</td>
                                <td>{{$v['linkurl']}}</td>
                                <td><img src="{{asset($v['linkthumb'])}}" style="height:50px " alt=""></td>
                                <td>
                                    <div class="tpl-table-black-operation">
                                        <a href="{{url("admin/link/{$v['id']}/edit")}}" title="编辑">
                                            <i class="am-icon-pencil"></i> 编辑
                                        </a>
                                        <a href="javascript:;" onclick="member_delete({{$v['id']}})" class="tpl-table-black-operation-del" title="删除">
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
    <script>
        function member_delete(id) {
            layer.confirm('真要删除这个链接吗？', {
                btn: ['忍痛删除','舍不得'] //按钮
            }, function(){
                $.post(
                    '{{url('admin/link')}}/'+id,
                    {
                        '_method' : 'delete',
                        '_token' : '{{csrf_token()}}'
                    },
                    function (msg){
                        var icon= 0;
                        if (msg.status){
                            icon = 5;
                        } else {
                            icon = 6;
                            setTimeout(function(){
                                location.href = '/admin/link';
                            },1000);
                        }
                        layer.alert(msg.msg,{icon:icon});
                    },
                    'json'
                );
            }, function(){

            });
        }

        function chang(obj, id) {
            $.get('{{url('admin/link/order')}}/' + id + '-' + obj.value,function (msg) {
                layer.msg(msg.msg);
                setTimeout(function () {
                    location = '/admin/link';
                }, 2000);
            }, 'json');
        }
    </script>
@endsection
@section('style')
    <style>
        .theme-black #order_1{
            color:black;
        }
        .am-table .gradeX td{
            line-height:50px;
        }
    </style>
@endsection