@extends('home.layout.index')
@section('style')
    <link href="{{asset('home/css/buy.css')}}" rel="stylesheet" type="text/css" media="all"/>
    <script src="{{asset('home/js/qrcode.min.js')}}"></script>
@endsection
@section('content')
    <div id="bd">
        <input type="hidden" id="firstVisit" value="true">
        <ul class="progress">
            <li>
                <span class="step first"><strong>1. </strong>选择影片场次</span>
            </li>
            <li>
                <span class="triangle triangle-left"><em></em><i></i></span>
                <span class="step"><strong>2. </strong>选择座位</span>
            </li>
            <li>
                <span class="triangle triangle-left"><em></em><i></i></span>
                <span class="step"><strong>3. </strong>15分钟内付款</span>
            </li>
            <li class="on">
                <span class="triangle triangle-left"><em></em><i></i></span>
                <span class="step"><strong>4. </strong>影院内取票机取票</span>
            </li>
        </ul>
        <div class="pg-pay body">
            <h2>支付成功，请用下面的"字符串码"或者"二维码到"影院兑换。。。。</h2>
            <div style="text-align: center">
                {{$id}}
            </div>
            <div style="text-align: center">
                {!! $code !!}
            </div>
            <div id="qrcode" style="text-align: center"></div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function (){
            var e = new QRCode(document.getElementById('qrcode'));
            e.makeCode('{{$id}}');
        });
    </script>
@endsection