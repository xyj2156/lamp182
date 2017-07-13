@extends('admin.layout.index')

@section('content')
    {{--标头--}}
    <div class="container-fluid am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 订单管理 <small>江洋八子</small></div>
                <p class="page-header-description">简单组合。。。干不简单的事情。。。</p>
            </div>
            {{--<!-- 搜索 -->--}}
            <div class="am-fl tpl-header-search">
                <form class="tpl-header-search-form" action="{{url('admin/orders')}}">
                    <button class="tpl-header-search-btn am-icon-search" type="submit"></button>
                    <input class="tpl-header-search-box" name="search" type="text" value="{{$search['search'] or ''}}" placeholder="搜索用户名。.">
                    <input class="tpl-header-search-box" name="number" type="text" value="{{$search['number'] or ''}}" placeholder="搜索订单号。.">
                </form>
            </div>
        </div>
    </div>
    <div class="row-content am-cf">
        {{--显示表格--}}
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-fl">管理员列表</div>
                </div>
                <div class="widget-body  widget-body-lg am-fr">
                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                        <thead>
                        <tr>
                            <th>订单号</th>
                            <th>用户</th>
                            <th>创建时间</th>
                            <th>状态</th>
                            <th>座位号</th>
                            <th>单价</th>
                            <th>总价</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $k=>$v)
                            <tr class="gradeX">
                                <td>{{$v->id}}</td>
                                <td>{{$v->username}}</td>
                                <td>{{date('Y-m-d',$v->ctime)}}</td>
                                <td>@if($v->status==1) '未付款'
									@elseif($v->status==2) '已付款'
									@elseif($v->status==3) '已发货'
									@elseif($v->status==4) '订单完成'
									@else '订单废除'
									@endif	
                                </td>
                                <td>{{$v->seat}}</td>
                                <td>{{$v->price}}</td>
                                <td>{{$v->num}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @include('admin.layout.render')
                </div>
            </div>
        </div>
    </div>
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