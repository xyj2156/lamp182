{{--
   分页公共方法 分页传递给视图的参数必须是 $data
--}}
<div class="am-u-lg-12 am-cf">
    <div class="am-fr">
        <ul class="am-pagination tpl-pagination">
            <li class="{{ ($data->currentPage() == 1) ? 'am-disabled' : '' }}">
                <a href="{{ $data->url(1) }}{{$tmp}}">«</a>
            </li>
            @for ($i = 1; $i <= $data->lastPage(); $i++)
                <li class="{{ ($data->currentPage() == $i) ? 'am-active' : '' }}">
                    <a href="{{ $data->url($i) }}{{$tmp}}">{{ $i }}</a>
                </li>
            @endfor
            <li class="{{ ($data->currentPage() == $data->lastPage()) ? 'am-disabled' : '' }}">
                <a href="{{ $data->url($data->currentPage()+1) }}{{$tmp}}">
                    »
                </a>
            </li>
        </ul>
    </div>
</div>