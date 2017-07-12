@extends('admin.layout.index')

@section('content')
    {{--标头--}}
    <div class="container-fluid am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 轮播图管理 <small>江洋八子</small></div>
                <p class="page-header-description">简单组合。。。干不简单的事情。。。</p>
            </div>
            <div class="am-u-lg-3 tpl-index-settings-button">
                <button type="button" class="page-header-button" onclick="location.href='{{url('admin/config/create')}}';"><span class="am-icon-paint-brush"></span> 添加轮播图</button>
            </div>
        </div>
    </div>
    <div class="row-content am-cf">
    {{--显示表格--}}
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-fl">轮播图列表</div>
                </div>
                <div class="widget-body  widget-body-lg am-fr">
                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                        <thead>
                            <tr>
                                <th>排序</th>
                                <th>ID</th>
                                <th>标题</th>
                                <th>图片</th>
                                <th>链接地址</th>
                                <th>更新时间</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $k => $v)
                            <tr class="gradeX">
                                <td><input type="number" max="255" data-id="{{$v -> id}}" value="{{$v -> order}}" width="20"></td>
                                <td>{{$v -> id}}</td>
                                <td>{{$v -> title}}</td>
                                <td><img src="{{asset($v -> pic)}}" alt="" style="height:100px"></td>
                                <td><a href="{{$v -> url}}" target="_blank">{{$v -> url}}</a></td>
                                <td>{{$v -> updated_at}}</td>
                                <td>
                                    <div class="tpl-table-black-operation">
                                        <a href="{{url("admin/config/edit?id={$v['id']}")}}" title="编辑">
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
@endsection

@section('script')
    <script>
        function member_delete(id) {
            layer.confirm('真要删除这个轮播图吗？', {
                btn: ['忍痛删除','舍不得'] //按钮
            }, function(){
                $.post(
                    '{{url('admin/config/delete')}}',
                    {
                        '_token' : '{{csrf_token()}}',
                        'id' : id
                    },
                    function (msg){
                        var icon= 0;
                        if (msg.status){
                            icon = 5;
                        } else {
                            icon = 6;
                            setTimeout(function(){
                                location.href = '{{url('admin/config/banner')}}';
                            },1000);
                        }
                        layer.alert(msg.msg,{icon:icon});
                    },
                    'json'
                );
            }, function(){

            });
        }

        $(function (){
            $('td>input').change(function (){
                var me = $(this);
                $.get(
                    '{{url('admin/config/order')}}',
                    {
                        'id' : me.attr('data-id'),
                        'order' : me.val()
                    }
                    ,function (msg){
                        layer.msg(msg.msg);
                        if (!msg.status){
                            var obj = {};
                            var arr = [];

                            $('.gradeX').each(function (){
                                var o = $(this);
                                var i = o.find('td').find('input').val();
                                obj[i] = o;

                                arr[arr.length] = i;
                            });
                            if(obj.length <= 1) return false;

                            arr.sort(function(a, b){
                                return a - b;
                            });

                            var i = arr.length;
                            var k = Object.keys(obj).length;
                            if(i != k){
                                location = '{{url('admin/config/banner')}}';
                                return false;
                            } else {
                                arr.time = setInterval(function () {
                                    i --;
                                    var tmp = obj[arr[i]];
                                    tmp.parent().prepend(tmp.hide().show(400));
                                    if(i <= 0) clearInterval(arr.time);
                                }, 50);
                            }
                        }
                    }
                );
            });
        });
    </script>
@endsection

@section('style')
    <style>
        .theme-black tr>td>input{
            color:#000;
        }
        tr>td>input{width:30px;}
    </style>
@endsection