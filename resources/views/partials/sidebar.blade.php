<!-- Logo -->
<div class="logo" data-ng-controller="AdminAppCtrl">
    <a href="#/">
        <i class="logo-icon fa fa-plus"></i>
        <span>Lebanese Red Cross</span>
    </a>
</div>
<div id="nav-wrapper">
    <ul id="nav"
        data-ng-controller="NavCtrl"
        data-slim-scroll
        data-collapse-nav>
        <li  class="nav-group">
            <a id='home-dashboard' href="{{route('home-dashboard')}}"> <i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>
        <li class="nav-group">
            <a href="users"> <i class="fa fa-users"></i> <span>Users</span></a>
            <ul>
                <li><a id='users-list' href="{{route('users-list')}}"><i class="fa fa-angle-right"></i><span> List </span></a></li>
                <li><a href="/register"><i class="fa fa-angle-right"></i><span> Register</span></a></li>
            </ul>
        </li>
        <li  class="nav-group">
            <a href="users"> <i class="fa fa-ambulance"></i> <span>Emergencies</span></a>
            <ul>
                <li><a id="emergencies-list" href="{{route('emergencies-list')}}"><i class="fa fa-angle-right"></i><span> List </span></a></li>
                <li><a id="emergency-create" href="{{route('emergency-create')}}"><i class="fa fa-angle-right"></i><span>Add</span></a></li>
            </ul>
        </li>
        <li class="nav-group">
            <a> <i class="fa fa-tint"></i> <span>Blood</span></a>
            <ul>
                <li id='blood-donors-list' ><a href="{{ route('blood-donors-list') }}"><i class="fa fa-angle-right"></i><span> Donors </span></a></li>
                <li id='blood-requests-list' ><a href="{{ route('blood-requests-list') }}"><i class="fa fa-angle-right"></i><span> Requests </span></a></li>
            </ul>
        </li>
        <li  class="nav-group">
            <a id='contacts-list' href="{{route('contacts-list')}}"> <i class="fa fa-book"></i> <span>Contacts</span></a>
        </li>
    </ul>
</div>

<script>
    var entry = $('#<?php echo Route::current()->getName() ?>');

    entry.closest('.nav-group').addClass('active').trigger('click');
    entry.closest('ul').css('display','block');
</script>