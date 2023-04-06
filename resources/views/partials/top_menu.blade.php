<div class="navbar navbar-expand-md navbar-dark" style="background: #0071bc;">
    @if(Auth::user())
    <div class="d-md-none">
        {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button> --}}
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>
    @endif
    <div class="mt-2 mx-auto">
        <a href="{{ route('dashboard') }}" class="d-inline-block">
        <h4 class="text-bold text-white">{{ Qs::getSystemName() }}</h4>
        </a>
    </div>
    @if(Auth::user())
    <a href="#" class="navbar-nav-link dropdown-toggle d-block d-md-none" data-toggle="dropdown">
        <i class="icon-paragraph-justify3"></i>
    </a>
    
    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li> 
        </ul> 
        <span class="navbar-text ml-md-3 mr-md-auto d-none d-md-block"></span>

        <ul class="navbar-nav">

            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link dropdown-toggle d-none d-md-block" data-toggle="dropdown">
                    <img style="width: 38px; height:38px;" src="{{ Auth::user()->photo }}" class="rounded-circle" alt="photo">
                    <span>{{ Auth::user()->name }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="#" class="dropdown-item"><i class="icon-user"></i> <span>Xin chào {{ Auth::user()->name }}</span></a>
                    {{-- <div class="dropdown-divider"></div> --}}
                    <a href="{{ route('my_account') }}" class="dropdown-item"><i class="icon-cog5"></i> Chỉnh sửa thông tin</a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();" class="dropdown-item"><i class="icon-switch2"></i> Đăng xuất</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul> 
    </div>
    @endif
</div>
