<ul class="nav navbar-nav">
    @if(auth('admin')->user())
        <li @if (Request::is('admin/quyu*')) class="active" @endif>
            <a href="/admin/quyu">区域管理</a>
        </li>
        <li @if (Request::is('admin/qudao*')) class="active" @endif>
            <a href="/admin/qudao">渠道管理</a>
        </li>
        <li @if (Request::is('admin/mendian*')) class="active" @endif>
            <a href="/admin/mendian">门店管理</a>
        </li>
        <li @if (Request::is('admin/model*')) class="active" @endif>
            <a href="/admin/model">型号管理</a>
        </li>
        <li @if (Request::is('admin/zhengce*')) class="active" @endif>
            <a href="/admin/zhengce">政策管理</a>
        </li>
        <li @if (Request::is('admin/sale*')) class="active" @endif>
            <a href="/admin/sale">销售管理</a>
        </li>

    @endif
</ul>

<ul class="nav navbar-nav navbar-right">
    @if(auth('admin')->user())
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
               aria-expanded="false">
                {{ auth('admin')->user()->name }}
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="/admin/logout">Logout</a></li>
            </ul>
        </li>
    @else
        <li><a href="/admin/login">Login</a></li>
    @endif
</ul>