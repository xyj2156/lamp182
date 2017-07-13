@extends('admin.layout.index')

@section('content')
    {{--标头--}}
    <div class="container-fluid am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 管理员管理 <small>江洋八子</small></div>
                <p class="page-header-description">简单组合。。。干不简单的事情。。。</p>
            </div>
            {{--<!-- 搜索 -->--}}
            <div class="am-fl tpl-header-search">
                <form class="tpl-header-search-form" action="{{url('admin/review')}}">
                    <button class="tpl-header-search-btn am-icon-search" type="submit"></button>
                    <input class="tpl-header-search-box" name="search" type="text" value="{{$search['search'] or ''}}" placeholder="搜索用户名。.">
                </form>
            </div>
        </div>
    </div>
    <div class="row-content am-cf">
        {{--显示表格--}}
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-fl">用户评论</div>
                </div>
                <div class="widget-body  widget-body-lg am-fr">
                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>用户名</th>
                            <th>评论的电影</th>
                            <th>内容</th>
                            <th>发表时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $k => $v)
                            <tr class="gradeX">
                                <td>{{$v->id}}</td>
                                <td><a href="{{url('admin/review')}}?search={{$v->username}}">{{$v->username}}</a></td>
                                <td><a href="{{url('admin/review')}}/{{$v->fid}}">{{$v->filmName}}</a></td>
                                <td>{{$v->content}}</td>
                                <td>{{date('Y-m-d H:i:s',$v->time)}}</td>
                                <td>
                                <div class="tpl-table-black-operation">
                                    <a href="javascript:;" onclick="review_delete({{$v->id}})" class="tpl-table-black-operation-del" title="删除">
                                        <i class="am-icon-trash"></i> 删除
                                    </a>
                                </div>
                                </td>
                        @endforeach        
                            </tr>
                        
                        </tbody>
                    </table>
                    @include('admin.layout.render')
                </div>
            </div>
        </div>
    </div>
    
@endsection
	<script>
        function review_delete(id) {
            layer.confirm('真要删除这个评论吗？', {
                btn: ['忍痛删除','舍不得'] //按钮
            }, function(){
                $.post(
                    '{{url("admin/review")}}/'+id,
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
                                location.href = '{{url("admin/review")}}?search={{$search["search"] or ""}}';
                            },1000);
                        }
                        layer.alert(msg.msg,{icon:icon});
                    },
                    'json'
                );
            }, function(){

            });
        }
    </script>
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