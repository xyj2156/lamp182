@extends('admin.layout.index')

@section('content')
    {{--标头--}}
    <div class="container-fluid am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 分类管理 <small>江洋八子</small></div>
                <p class="page-header-description">简单组合。。。干不简单的事情。。。</p>
            </div>
        </div>
    </div>
    <div class="row-content am-cf">
    {{--显示表格--}}
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-fl">分类列表</div>
                </div>
                <div class="widget-body  widget-body-lg am-fr">
                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>分类名</th>
                                <th>父ID</th>
                                <th>父类名</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $k => $v)
                            <tr class="gradeX">
                                <td>{{$v ['id'] }}</td>
                                <td>{{$v ['_name']}}</td>
                                <td>{{$v ['pid'] }}</td>
                                <td>{{$v ['pid'] ?config('film.type')[$v ['pid'] ]:'顶级分类'}}</td>
                                <td>
                                    <div class="tpl-table-black-operation">
                                        <a href="{{url("admin/type/{$v['id']}/edit")}}" title="编辑" onclick="return isEdit(this, '{{$v['id']}}')">
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
            layer.confirm('真要删除这个分类吗？', {
                btn: ['忍痛删除','舍不得'] //按钮
            }, function(){
                $.post(
                    '{{url('admin/type')}}/'+id,
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
                                location.href = '/admin/type';
                            },1000);
                        }
                        layer.alert(msg.msg,{icon:icon});
                    },
                    'json'
                );
            }, function(){

            });
        }

        function isEdit(obj, num) {
            if('123'.indexOf(num) == -1){
                layer.confirm('修改分类会导致所有与之相关联的电影中的分类信息，一起修改，确认要修改吗？', {
                    btn: ['改','再想想'] //按钮
                }, function(){
                    location.href = obj.href;
                }, function(){

                });
            }else {
                layer.msg('顶级分类不能编辑')
            }

            return false;
        }
    </script>
@endsection