<header class="clearfix">

    <div class="top-nav">
        <ul class="nav-left list-unstyled">
            <li>
                <!-- needs to be put after logo to make it working-->
                <div class="menu-button" toggle-off-canvas>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </div>

            </li>
            <li>
                <a href="#/" data-toggle-min-nav
                   class="toggle-min"
                        ><i class="fa fa-bars"></i></a>
            </li>
            <li class="dropdown text-normal nav-profile">
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="text-small">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
                </a>

                <div class="dropdown-menu pull-left with-arrow panel panel-default">

                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="#/pages/profile">
                                <i class="fa fa-user color-info"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#/tasks">
                                <i class="fa fa-check color-success"></i>
                                <span>Tasks</span>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#/pages/lock-screen">
                                <i class="fa fa-lock color-warning"></i>
                                <span>Lock</span>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="/auth/logout">
                                <i class="fa fa-sign-out color-danger"></i>
                                <span>Log out</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>


        <ul class="nav-right-button pull-right list-unstyled">

            <li>
                <a class="btn btn-primary">
                    Emergency &nbsp;&nbsp;<i class="fa fa-plus-circle"></i>
                </a>
                <a href="{{ route('blood-request-create') }}" class="btn btn-warning">
                    Blood &nbsp;&nbsp;<i class="fa fa-plus-circle"></i>
                </a>
            </li>

        </ul>

        <ul class="nav-right pull-right list-unstyled">

            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle">
                    <i class="fa fa-bell nav-icon color-info"></i>
                    <span class="badge badge-danger">3</span>
                </a>

                <div class="dropdown-menu pull-right with-arrow panel panel-default">
                    <div class="panel-heading">
                        You have 3 notifications.
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="javascript:;" class="media">
                                    <span class="pull-left media-icon">
                                        <span class="circle-icon sm bg-success"><i class="fa fa-bell-o"></i></span>
                                    </span>

                                <div class="media-body">
                                    <span class="block">New tasks needs to be done</span>
                                    <span class="text-muted block">2min ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="javascript:;" class="media">
                                    <span class="pull-left media-icon">
                                        <span class="circle-icon sm bg-info"><i class="fa fa-bell-o"></i></span>
                                    </span>

                                <div class="media-body">
                                    <span class="block">Change your password</span>
                                    <span class="text-muted">3 hours ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="javascript:;" class="media">
                                    <span class="pull-left media-icon">
                                        <span class="circle-icon sm bg-danger"><i class="fa fa-bell-o"></i></span>
                                    </span>

                                <div class="media-body">
                                    <span class="block">New feature added</span>
                                    <span class="text-muted">9 hours ago</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="panel-footer">
                        <a href="javascript:;">Show all notifications.</a>
                    </div>
                </div>
            </li>
        </ul>


    </div>

</header>


