@extends('admin.layout.index')

@section('content')
    {{--标头--}}
    <div class="container-fluid am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 影厅管理 <small>江洋八子</small></div>
                <p class="page-header-description">简单组合。。。干不简单的事情。。。</p>
            </div>
            {{--<!-- 搜索 -->--}}
            <div class="am-fl tpl-header-search">
                <form class="tpl-header-search-form" action="{{url('admin/filmrooms')}}">
                    <button class="tpl-header-search-btn am-icon-search" type="submit"></button>
                    <input class="tpl-header-search-box" name="search" type="text" value="{{$search['search'] or ''}}" placeholder="搜索影厅名。.">
                </form>
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
                                <th>影厅名称</th>
                                <th>座位概略</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $k => $v)
                            <tr class="gradeX">
                                <td>{{$v -> id}}</td>
                                <td>{{$v -> name}}</td>
                                <td>
                                    <?php
                                        $seat = explode(',', $v -> seat);
                                        foreach($seat as $kk => $vv){
                                            $seat[$kk] = str_split($vv);
                                        }
                                    ?>

                                    <table cellpadding="0" cellspacing="12" border="1">
                                        @foreach($seat as $kk =>$vk)
                                            <tr>
                                                @foreach($vk as $vvk)
                                                    <td style="@if($vvk == 'a')background:yellow;@endif"></td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </table>
                                </td>
                                <td>
                                    <div class="tpl-table-black-operation">
                                        <a href="{{url("admin/filmrooms/{$v -> id}/edit")}}" title="编辑">
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
                    @include('admin.layout.render')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function member_delete(id) {
            layer.confirm('真要删除这个影厅吗？', {
                btn: ['忍痛删除','舍不得'] //按钮
            }, function(){
                $.post(
                    '{{url('admin/filmrooms')}}/'+id,
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
                                location.href = '/admin/filmrooms';
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
@endsection

@section('meta')
    <style>
        #example-r .gradeX>td{
            vertical-align:middle;
        }
    </style>
@endsection