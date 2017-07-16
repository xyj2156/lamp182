@extends('home.layout.index')
@section('content')
    <div id="bd">
        <input type="hidden" id="firstVisit" value="true">
        <ul class="progress">
            <li>
                <span class="step first"><strong>1. </strong>选择影片场次</span>
            </li>
            <li class="on">
                <span class="triangle triangle-left"><em></em><i></i></span>
                <span class="step"><strong>2. </strong>选择座位</span>
            </li>
            <li class="next not">
                <span class="triangle triangle-left"><em></em><i></i></span>
                <span class="step"><strong>3. </strong>15分钟内付款</span>
            </li>
            <li class="next not">
                <span class="triangle triangle-left"><em></em><i></i></span>
                <span class="step"><strong>4. </strong>影院内取票机取票</span>
            </li>
        </ul>
        <div class="pg-pay body">
            <h2 class="top_title"><a href="{{url('filmdetails')}}/{{$film -> id}}">{{$film -> name}}</a></h2>
            <div class="demo">
                <div id="seat-map">
                    <div class="front">屏幕</div>
                </div>
                <div class="booking-details">
                    <p>影片：<a href="{{url('filmdetails')}}/{{$film -> id}}">{{$film -> name}}</a></p>
                    <p><img src="{{asset($film -> film_pic)}}" alt="{{$film -> name}}" style="max-height: 130px;"></p>
                    <p>开映时间：<span>{{date('Y-m-d H:i:s', $playing -> start_time)}}</span></p>
                    <p>结束时间：<span>{{date('Y-m-d H:i:s', $playing -> end_time)}}</span></p>
                    <p>座位：</p>
                    <ul id="selected-seats"></ul>
                    <p>票数：<span id="counter">0</span></p>
                    <p>总计：<b>￥<span id="total">0</span></b></p>
                    <div id="legend"></div>
                    <button class="checkout-button btn">确定购买</button>
                </div>
                <div style="clear:both"></div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <!--    购物流程    -->
    <link href="{{asset('home/css/buy.css')}}" rel="stylesheet" type="text/css" media="all"/>
    <!--    引入座位    -->
    <script src="{{asset('home/js/jquery.seat-charts.min.js')}}"></script>
@endsection

@section('script')
    <script>
        var price = Number('{{ $film -> price }}'); //票价
        $(document).ready(function() {
            var $cart = $('#selected-seats'), //座位区
                $counter = $('#counter'), //票数
                $total = $('#total'); //总计金额

            var sc = $('#seat-map').seatCharts({
                map: [  //座位图
                    {!! '"'.str_replace(',','","',$room -> seat).'"'!!}
                ],
                naming : {
                    top : false,
                    getLabel : function (character, row, column) {
                        return column;
                    }
                },
                legend : { //定义图例
                    node : $('#legend'),
                    items : [
                        [ 'a', 'available',   '可选座' ],
                        [ 'a', 'unavailable', '已售出']
                    ]
                },
                click: function () { //点击事件
                    if (this.status() == 'available') { //可选座
                        if($counter.text() > 3) {
                            layer.msg('最多选择4张') ;
                            return 'available';
                        }
                        $('<li>'+(this.settings.row+1)+'排'+this.settings.label+'座</li>')
                            .attr('id', 'cart-item-'+this.settings.id)
                            .data('seatId', this.settings.id)
                            .appendTo($cart);

                        $counter.text(sc.find('selected').length+1);
                        $total.text(accAdd(recalculateTotal(sc),price));

                        return 'selected';
                    } else if (this.status() == 'selected') { //已选中
                        //更新数量
                        $counter.text(sc.find('selected').length-1);
                        //更新总计
                        $total.text(Subtr(recalculateTotal(sc), price));

                        //删除已预订座位
                        $('#cart-item-'+this.settings.id).remove();
                        //可选座
                        return 'available';
                    } else if (this.status() == 'unavailable') { //已售出
                        return 'unavailable';
                    } else {
                        return this.style();
                    }
                }
            });
            //已售出的座位
            sc.get(['1_2', '4_4','4_5','6_6','6_7','8_5','8_6','8_7','8_8', '10_1', '10_2']).status('unavailable');
//          设定牌号
            s = $('#seat-map div.seatCharts-seat').each(function (k, v){
                var arr = v.id.split('_');
                v.title = arr[0] + '排' + arr[1] + '号';
            });

            $('.checkout-button').click(function (){
                var seat = sc.find('selected').seatIds;
                var seat = seat.join(',');
                console.log(seat);
                $.post('{{url('order')}}',{
                    _token : '{{csrf_token()}}',
                    seat : seat,
                    id : '{{$film -> id}}'
                },function (data){
                    console.log(data);
                    layer.msg(data.msg);
                    if(!data.status){

                    }
                },'json');
            });
        });
        //计算总金额
        function recalculateTotal(sc) {
            var total = 0;
            sc.find('selected').each(function () {
                total = accAdd(total, price);
            });

            return total;
        }

        //除法函数，用来得到精确的除法结果
        //说明：javascript的除法结果会有误差，在两个浮点数相除的时候会比较明显。这个函数返回较为精确的除法结果。
        //调用：accDiv(arg1,arg2)
        //返回值：arg1除以arg2的精确结果

        function accDiv(arg1,arg2){
            var t1=0,t2=0,r1,r2;
            try{t1=arg1.toString().split(".")[1].length}catch(e){}
            try{t2=arg2.toString().split(".")[1].length}catch(e){}
            with(Math){
                r1=Number(arg1.toString().replace(".",""))
                r2=Number(arg2.toString().replace(".",""))
                return (r1/r2)*pow(10,t2-t1);
            }
        }
        //给Number类型增加一个div方法，调用起来更加方便。
        Number.prototype.div = function (arg){
            return accDiv(this, arg);
        };

        //乘法函数，用来得到精确的乘法结果
        //说明：javascript的乘法结果会有误差，在两个浮点数相乘的时候会比较明显。这个函数返回较为精确的乘法结果。
        //调用：accMul(arg1,arg2)
        //返回值：arg1乘以arg2的精确结果

        function accMul(arg1,arg2)
        {
            var m=0,s1=arg1.toString(),s2=arg2.toString();
            try{m+=s1.split(".")[1].length}catch(e){}
            try{m+=s2.split(".")[1].length}catch(e){}
            return Number(s1.replace(".",""))*Number(s2.replace(".",""))/Math.pow(10,m)
        }
        //给Number类型增加一个mul方法，调用起来更加方便。
        Number.prototype.mul = function (arg){
            return accMul(arg, this);
        };


        //加法函数，用来得到精确的加法结果
        //说明：javascript的加法结果会有误差，在两个浮点数相加的时候会比较明显。这个函数返回较为精确的加法结果。
        //调用：accAdd(arg1,arg2)
        //返回值：arg1加上arg2的精确结果

        function accAdd(arg1,arg2){
            var r1,r2,m;
            try{r1=arg1.toString().split(".")[1].length}catch(e){r1=0}
            try{r2=arg2.toString().split(".")[1].length}catch(e){r2=0}
            m=Math.pow(10,Math.max(r1,r2));
            return (arg1*m+arg2*m)/m
        }
        //给Number类型增加一个add方法，调用起来更加方便。
        Number.prototype.add = function (arg){
            return accAdd(arg,this);
        };

        //在你要用的地方包含这些函数，然后调用它来计算就可以了。
        //比如你要计算：7*0.8 ，则改成 (7).mul(8)
        //其它运算类似，就可以得到比较精确的结果。



        //减法函数
        function Subtr(arg1,arg2){
            var r1,r2,m,n;
            try{r1=arg1.toString().split(".")[1].length}catch(e){r1=0}
            try{r2=arg2.toString().split(".")[1].length}catch(e){r2=0}
            m=Math.pow(10,Math.max(r1,r2));
            //last modify by deeka
            //动态控制精度长度
            n=(r1>=r2)?r1:r2;
            return ((arg1*m-arg2*m)/m).toFixed(n);
        }
    </script>
@endsection