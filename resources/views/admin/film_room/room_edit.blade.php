@extends('admin.layout.index')

@section('content')
    <div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl"><a href="{{url('admin/filmrooms')}}">影厅管理 </a> > 添加影厅</div>
                    </div>
                    <div class="widget-body am-fr">
                        <form class="am-form tpl-form-line-form" method="post" action="{{url('admin/filmrooms')}}/{{$data -> id}}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="put">
                            <div class="am-form-group">
                                <label for="filmroom-name" class="am-u-sm-3 am-form-label">影厅号码/名字 <span class="tpl-form-line-small-title">FilmName</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="filmroom-name" required name="name" placeholder="请输入影厅号/名字" value="{{$data -> name}}">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label">座位信息 <span class="tpl-form-line-small-title">Seat</span></label>
                                <div class="am-u-sm-9" id="seat">
                                    <input type="number" value="{{$data -> row}}" name="row">排 <input type="number" value="{{$data -> col}}" name="col">列 黄色代表有座位,白色代表没有
                                    <div id="seats"></div>
                                </div>
                            </div>
                            <input type="hidden" name="seat" value="">
                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function () {
            var seats = $('#seats');
            var xin = '';
//
            $('#seat>input').change(function (e) {
                var a = $('#seat>input');
                var m = a.eq(0).val();
                var n = a.eq(1).val();

                createInput();
                create(m,n);
                show(xin);
            });

//            冒泡代理
            seats.click(function (e){
                if(e.target.nodeName == 'TD'){
                    $(e.target).toggleClass('active');
                }
            });

//            生成 座位表
            function create(m,n){
                var seat = '<table border="1" cellspacing="2" cellpadding="12px">';
                for (var i = 0; i < m; i++){
                    seat += '<tr>';
                    for (var o = 0; o < n; o++){
                        seat += '<td class="active">' + (o+1) + '</td>';
                    }
                    seat += '</tr>';
                }
                seat += '</table>';
                seats.html(seat);
            }
//            解析座位信息
            /**
             * 解析座位信息
             * @param seat
             * @returns {boolean}
             */
            function show(seat){
                if(!seat) {
                    return false;
                }

                var tr = seat.split(',');
                var s = seats.find('td');
                var mm = $('#seat>input').eq(0).val();
                var nn = $('#seat>input').eq(1).val();
                for (var i = 0; i< tr.length && i < mm; i ++){
                    if(!tr[i]) continue;
                    var td = tr[i].split('');
                    for (var j = 0; j < td.length && j < nn ; j++){
                        if(td[j] === '_'){
                            s.eq(i*nn + j).removeClass('active');
                        }
                    }
                }
            }
//            创建传给后台的座位信息
            function createInput(){
                var tr = seats.find('tr'),seat = '';

                $.each(tr, function (){
                    $(this).find('td').each(function (){
                        if(this.className == 'active')
                            seat += 'a';
                        else
                            seat += '_';
                    });
                    if(tr.eq(tr.length-1)[0] != this) seat += ',';
                });
                document.forms[0].seat.value = seat;
                xin = seat;
            }

//            初始生成表格
            create('{{$data -> row}}', '{{$data ->col}}');
//            初始如果后台传过来座位信息 解析
            show('{{$data -> seat}}');

//            提交
            $(document.forms[0]).submit(function (){
                createInput();
            });
        });
    </script>
@endsection

@section('style')
    <style>
        #seat input{
            display: inline-block;
            width: 30px;
        }
        #seat div{
            padding:20px;
        }
        #seats td{
            width:40px;
            height: 30px;
            text-align: center;
            cursor: pointer;
            -webkit-user-select: none;
            -ms-user-select: none;
            -moz-user-select: none;
        }
        #seats .active{
            background: yellow;
        }
    </style>
@endsection