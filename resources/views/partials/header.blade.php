<header class="clearfix">

    <div class="top-nav">
        <ul class="nav-left list-unstyled">
            <!-- <li> -->
                <!-- needs to be put after logo to make it working-->
                <!-- <div class="menu-button" toggle-off-canvas>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </div>

            </li>
            <li>
                <a href="#/" data-toggle-min-nav
                   class="toggle-min"
                        ><i class="fa fa-bars"></i></a>
            </li> -->
            <li class="app-logo">
                <i class="fa fa-plus"></i><span>LRC204</span>
            </li>
            <li class="app-nav {{ Request::is('/') ? 'active' : '' }}"><a href="{{route('home-dashboard')}}">Dashboard</a></li>
            <li class="app-nav {{ Request::is('emergencies*') ? 'active' : '' }}"><a href="{{route('emergencies-list')}}">Emergencies</a></li>
            <li class="app-nav {{ Request::is('missions*') ? 'active' : '' }}"><a href="">Missions</a></li>
            <li class="app-nav {{ Request::is('blood*') ? 'active' : '' }}"><a href="">Blood</a></li>
            <li class="app-nav {{ Request::is('borrowings*') ? 'active' : '' }}"><a href="">Borrowings</a></li>
            <li class="app-nav {{ Request::is('sad*') ? 'active' : '' }}"><a href="">SAD</a></li>

            <li class="dropdown text-normal nav-profile">
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="text-small">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
                </a>

                <div class="dropdown-menu pull-left with-arrow panel panel-default">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-btn fa-sign-out"></i> Logouts
                            </a>
                            <form id="logout-form"
                                  action="{{ url('/logout') }}"
                                  method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>


        <ul class="nav-right-button pull-right list-unstyled">

            <li>
                <a href="{{route('emergency-create')}}" class="btn btn-primary">
                    Emergency &nbsp;&nbsp;<i class="fa fa-plus-circle"></i>
                </a>
                <a href="{{ route('blood-request-create') }}" class="btn btn-warning">
                    Blood &nbsp;&nbsp;<i class="fa fa-plus-circle"></i>
                </a>
            </li>

        </ul>
    </div>
</header>


