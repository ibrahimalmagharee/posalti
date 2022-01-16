
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light bg-info navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item">
                    <a class="navbar-brand" href="{{route('admin.home')}}">
                        <img class="brand-logo" alt="alt" src="{{asset('/public/web/images/logo-index.png')}}" style="width: 30%">
                        <h4 class="brand-text font-weight-bold"> Control panel</h4>
                    </a>
                </li>
                <li class="nav-item d-md-none">
                    <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                        <span class="mr-1">Welcome,
                            <span class="user-name text-bold-700">{{auth()->user()->name}}</span>
                        </span>
                        <span class="avatar avatar-online">
                            <img src="{{asset('/public/admin/images/admin-profile.png')}}" alt="avatar"><i></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{route('admin.profile.create')}}"><i class="ft-user"></i>Update profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" ><i class="ft-power"></i>
                                <form method="post" action="{{ route('logout') }}" style="position: absolute; top: 66%; left: 36px">
                                    @csrf
                                    <button type="submit" style="background: none;border: none;">Logout</button>
                                </form>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
