<div class="left-sidebar">
    <!-- 用户信息 -->
    <div class="tpl-sidebar-user-panel">
        <div class="tpl-user-panel-slide-toggleable">
            <div class="tpl-user-panel-profile-picture">
                <img src="{{asset(session('admin_user') -> uface)}}" alt="">
            </div>
            <span class="user-panel-logged-in-text">
              <i class="am-icon-circle-o am-text-success tpl-user-panel-status-icon"></i>
              {{session('admin_user')['username']}}
          </span>
            <a href="{{url('admin/userset/create')}}" class="tpl-user-panel-action-link"> <span class="am-icon-pencil"></span> 账号设置</a>
        </div>
    </div>

    <!-- 菜单 -->
    <ul class="sidebar-nav">
        <li class="sidebar-nav-heading">lamp182 在线订票系统<span class="sidebar-nav-heading-info"> <sub>---江洋八子-四个</sub></span></li>
        @foreach(config('film.nav') as $k => $v)
            {{-- auth 权限为 1 (老板号) 的让它显示后台管理员模块 --}}
            @if((session('admin_user') -> auth) != 1 && ($k == '后台管理员管理') )
                <?php continue;?>
            @endif
            @if(is_array($v))
                <li class="sidebar-nav-link">
                    <a href="javascript:;" class="sidebar-nav-sub-title">
                        <i class="am-icon-table sidebar-nav-link-logo"></i> {{$k}}
                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                    </a>
                    <ul class="sidebar-nav sidebar-nav-sub">
                        @foreach($v as $m => $n)
                            <li class="sidebar-nav-link">
                                <a href="{{url($n)}}">
                                    <span class="am-icon-angle-right sidebar-nav-link-logo"></span> {{$m}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                <li class="sidebar-nav-link">
                    <a href="{{url($v)}}">
                        <i class="am-icon-home sidebar-nav-link-logo"></i> {{$k}}
                    </a>
                </li>
            @endif
        @endforeach
        <div style="height: 80px;"></div>
    </ul>
</div>