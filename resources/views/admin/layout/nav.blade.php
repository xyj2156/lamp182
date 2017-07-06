<div class="left-sidebar">
    <!-- 用户信息 -->
    <div class="tpl-sidebar-user-panel">
        <div class="tpl-user-panel-slide-toggleable">
            <div class="tpl-user-panel-profile-picture">
                <img src="{{asset('admin/assets/img/user04.png')}}" alt="">
            </div>
            <span class="user-panel-logged-in-text">
              <i class="am-icon-circle-o am-text-success tpl-user-panel-status-icon"></i>
              {{session('admin_user')['username']}}
          </span>
            <a href="javascript:;" class="tpl-user-panel-action-link"> <span class="am-icon-pencil"></span> 账号设置</a>
        </div>
    </div>

    <!-- 菜单 -->
    <ul class="sidebar-nav">
        <li class="sidebar-nav-heading">lamp182 在线订票系统<span class="sidebar-nav-heading-info"> <sub>---江洋八子-四个</sub></span></li>
        <li class="sidebar-nav-link">
            <a href="{{url('admin/index')}}" class="active">
                <i class="am-icon-home sidebar-nav-link-logo"></i> 首页
            </a>
        </li>
        <li class="sidebar-nav-link">
            <a href="javascript:;" class="sidebar-nav-sub-title">
                <i class="am-icon-table sidebar-nav-link-logo"></i> 前台用户管理
                <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
            </a>
            <ul class="sidebar-nav sidebar-nav-sub">
                <li class="sidebar-nav-link">
                    <a href="{{url('admin/user/create')}}">
                        <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 添加用户
                    </a>
                </li>

                <li class="sidebar-nav-link">
                    <a href="{{url('admin/user/')}}">
                        <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 查看用户
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>