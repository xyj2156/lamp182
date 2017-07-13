@extends('admin.layout.index')

@section('content')
    <div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl"><a href="">播放影片管理 </a> > 添加影片</div>
                    </div>
                    <div class="widget-body am-fr">
                        <form class="am-form tpl-form-line-form" method="post" action="{{url('admin/filmroom')}}">
                            {{csrf_field()}}
                            <div class="am-form-group">
                                <label for="age" class="am-u-sm-3 am-form-label">影厅号码/名字 <span class="tpl-form-line-small-title">FilmName</span></label>
                                <div class="am-u-sm-9">
                                    <select data-am-selected="{searchBox: 99}" style="display: none;" name="rid" >
                                        <option value="0">==请在下面输入框筛选==</option>
                                        @foreach($filmroom as $kk => $vv)<option {{old('rid') == $vv -> id ? 'selected' : ''}} value="{{$vv -> id}}">{{$vv -> name}}</option>@endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="age" class="am-u-sm-3 am-form-label">播放电影 <span class="tpl-form-line-small-title">Film</span></label>
                                <div class="am-u-sm-9">
                                    <select data-am-selected="{searchBox: 99}" style="display: none;" name="fid">
                                        <option value="0">==请在下面输入框筛选==</option>
                                        @foreach($film as $k => $v)<option {{old('fid') == $v -> id ? 'selected' : ''}} value="{{$v -> id}}">{{$v -> name}}</option>@endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="phone" class="am-u-sm-3 am-form-label">开始播放时间 <span class="tpl-form-line-small-title">StartTime</span></label>
                                <div class="am-u-sm-9">
                                    <input type="datetime-local" class="tpl-form-input" required id="phone" name="start_time" style="width:200px" placeholder="开始日期" value="{{str_replace('CST','T',date('Y-m-dTH:i:s'))}}">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="email" class="am-u-sm-3 am-form-label">结束播放时间 <span class="tpl-form-line-small-title">EndTime</span></label>
                                <div class="am-u-sm-9">
                                    <input type="datetime-local" class="tpl-form-input" required id="email" style="width:200px" name="end_time" placeholder="结束日期"  value="{{str_replace('CST','T',date('Y-m-dTH:i:s'))}}">
                                </div>
                            </div>
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
    <script src="{{asset('admin/assets/js/layui.js')}}"></script>
    <script>
        $(function () {
            $('#age').on('keydown', function (e) {
                if(e.keyCode !=13)  return ;
                var name = this.value;
                $.get('{{url('admin/films')}}/' + name, function (msg){
                    try {
                        console.log(msg);
                    } catch (e){
                        console.log(e);
                    }
                },'json');
                return false;
            });
        });
    </script>
@endsection