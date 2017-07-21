@extends('home.layout.index')
@section('style')
    <link href="{{asset('home/css/buy.css')}}" rel="stylesheet" type="text/css" media="all"/>
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
            <li class="on">
                <span class="triangle triangle-left"><em></em><i></i></span>
                <span class="step"><strong>3. </strong>15分钟内付款</span>
            </li>
            <li class="next not">
                <span class="triangle triangle-left"><em></em><i></i></span>
                <span class="step"><strong>4. </strong>影院内取票机取票</span>
            </li>
        </ul>
        <div class="pg-pay body">
            <h2>请在<span id="J_RemainingTime" data-time="839"><em>15</em> 分钟 <em>00</em> 秒</span>内支付完成</h2>
            <p class="intro">超时订单会自动取消，如遇支付问题，请致电：<strong>{{config('webconf.tel')}}</strong></p>
            <p class="desc">请仔细核对场次信息，选座票不同于团购票，出票后将<i>无法退票和更换场次</i></p>
            <table class="details">
                <tbody><tr>
                    <th>观影时间</th>
                    <th>影片</th>
                    <th>影厅</th>
                    <th>座位</th>
                </tr>
                <tr>
                    <td>
                        ({{date('Y年m月d日',$start)}} 周{{config('film.week')[date('w', $start)]}})<strong> {{date('H:i', $start)}}</strong>
                    </td>
                    <td>{{$film}}</td>
                    <td>{{$room}}</td>
                    <td>{{str_replace(',','座,',str_replace('_','排',$res -> seat)).'座'}}</td>
                </tr>
                </tbody>
            </table>
            <p class="total">应付总额：<strong>￥{{$res -> price * $res -> num}}</strong></p>
            <form method="post" name="payForm" action="{{url('order/success')}}">
                <input type="hidden" name="magicCards" value="">
                <div class="pay-handle">
                    <input type="hidden" name="orderId" value="{{$name}}">
                    {{csrf_field()}}
                    <p class="pay-amount">支付：<em>￥{{$res -> price * $res -> num * config('film.zhe')[$auth]}}　<s>{{$res -> price * $res -> num }}</s></em></p>
                    <p><input type="submit" value="确认无误，去付款" class="btn btn-hot" gaevent="pay/submit"><a href="" target="_blank" id="J_submit"></a></p>
                    <p class="remind-pay"><i></i>电影票购票成功后，<strong>无法退换票</strong></p>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function (){
            var em = $('#J_RemainingTime').find('em');
            var min = em[0].innerHTML = {{$min}};
            var sec = em[1].innerHTML = {{$sec}};
            var time = setInterval(function (){
                sec --;
                if(sec <= 0){
                    sec = 59;
                    min --;
                }
                console.log(min,sec);
                if (min <= 0 && sec <= 0){
                    clearInterval(time);
                    layer.alert('订单超时', {icon:5});
                }
                em[0].innerHTML = min<10?'0' + min: min;
                em[1].innerHTML = sec<10?'0' + sec: sec;
            },1000);
        });
    </script>
@endsection