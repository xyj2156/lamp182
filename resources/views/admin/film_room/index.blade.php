@extends('admin.layout.index')

@section('content')
    {{--标头--}}
    <div class="container-fluid am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 影厅播放管理 <small>江洋八子</small></div>
                <p class="page-header-description">简单组合。。。干不简单的事情。。。</p>
            </div>

        </div>
    </div>
    <div class="row-content am-cf">
    {{--显示表格--}}
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-fl">播放列表</div>
                </div>
                <div class="widget-body  widget-body-lg am-fr">
                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>影厅名</th>
                                <th>影片</th>
                                <th>开播时间</th>
                                <th>结束时间</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $kk => $vv)
                            <tr class="gradeX">
                                <td>{{$vv['id']}}</td>
                                <td><a href="">{{$ridsR[$vv -> rid]}}</a></td>
                                <td><a href="{{url('admin/'.$vv['fid'])}}">{{$fidsR[$vv -> fid]}}</a></td>
                                <td>{{date('Y-m-d H:i:s', $vv['start_time'])}}</td>
                                <td>{{date('Y-m-d H:i:s', $vv['end_time'])}}</td>
                                {{--状态--}}
                                @if($time < $vv['start_time'])
                                    <td>该电影在{{date('Y-m-d H:i:s', $vv['start_time'])}}播放,请等待..</td>
                                @else
                                    @if($time > $vv['start_time'] && $time < $vv['end_time'])
                                        <td><span style="color:green">{{$ridsR[$vv -> rid]}}</span>：　<span style="color:orange">{{$fidsR[$vv -> fid]}}</span>　正在播放..</td>
                                    @elseif($time > $vv['end_time'])
                                        <td>该电影已播放完毕..</td>
                                    @endif
                                @endif
                                <td>
                                    <div class="tpl-table-black-operation">
                                        <a href="{{url('admin/filmroom')}}/{{$vv->id}}/edit" title="编辑">
                                            <i class="am-icon-pencil"></i> 编辑
                                        </a>
                                        <a href="javascript:;" onclick="member_delete({{$vv['id']}})" class="tpl-table-black-operation-del" title="删除">
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
    <script>
        function member_delete(id) {
            layer.confirm('真要删除这个用户吗？', {
                btn: ['忍痛删除','舍不得'] //按钮
            }, function(){
                $.post(
                    '{{url('admin/filmroom')}}/'+id,
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
                                location.href = '/admin/filmroom';
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