<!doctype html>
<html lang="cn">
{{--
......................打一个洞可以被多次使用......................
本页面有 style script meta content 这几个洞可以被使用

    引入head标签 公共style样式文件head标签里面放着
    其中 有style 洞
        $title 网页标题 变量
--}}
@include('admin.layout.head')
<body>
{{--引入头部文件--}}
@include('admin.layout.header')
@include('admin.layout.nav')
<div class="tpl-content-wrapper">
    @section('content')
        {{--内容区域--}}
    @show
</div>
{{--引入theme主题选择 js 和 html --}}
@include('admin.layout.theme')
{{--引入公共js文件--}}
@include('admin.layout.script')
{{--设置自定义引入js入口 --}}
@section('script')@show
</body>
</html>