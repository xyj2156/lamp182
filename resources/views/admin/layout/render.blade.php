{{--
   分页公共方法 分页传递给视图的参数必须是 $data
--}}
<div class="am-u-lg-12 am-cf">
    <div class="am-fr">
        {!! $data -> appends($search) -> render() !!}
    </div>
</div>
@section('style')
    <style>
        .pagination{
            margin: 0;
            padding: 0;
            padding-left: 0;
            margin: 1.5rem 0;
            list-style: none;
            color: #999;
            text-align: left;
            position: relative;
            font-family: "Segoe UI","Lucida Grande",Helvetica,Arial,"Microsoft YaHei",FreeSans,Arimo,"Droid Sans","wenquanyi micro hei","Hiragino Sans GB","Hiragino Sans GB W3",FontAwesome,sans-serif;
            font-weight: 400;
            line-height: 1.6;
        }
        .pagination>li{
            margin: 0 3px;
            display: inline-block;
        }
        .pagination>li span,.pagination>li a{
            color: #fff;
            padding: 6px 12px;
            background: #3f4649;
            border: none;
            border-radius: 0;
            margin-bottom: 5px;
            margin-right: 5px;
            display: block;
        }
        .pagination>li.active span{
            background: #167fa1;
            color: #fff;
            border: 1px solid #167fa1;
            padding: 6px 12px;
        }
    </style>
@endsection