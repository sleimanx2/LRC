
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
        data-collapse-nav
        data-highlight-active>
        <li>
            <a href="users"> <i class="fa fa-users"></i> <span>Users</span></a>
            <ul>
                <li><a href="{{route('users-list')}}"><i class="fa fa-angle-right"></i><span> List </span></a></li>
                <li><a href="/auth/register"><i class="fa fa-angle-right"></i><span> Register</span></a></li>
            </ul>
        </li>

        <li>
            <a href="users"> <i class="fa fa-ambulance"></i> <span>Emergencies</span></a>
            <ul>
                <li><a href="{{route('emergencies-list')}}"><i class="fa fa-angle-right"></i><span> List </span></a></li>
                <li><a href=""><i class="fa fa-angle-right"></i><span>Add</span></a></li>
            </ul>
        </li>
        <li>
            <a href="users"> <i class="fa fa-tint"></i> <span>Blood</span></a>
            <ul>
                <li><a href="{{ route('blood-donors-list') }}"><i class="fa fa-angle-right"></i><span> Donors </span></a></li>
                <li><a href="{{ route('blood-requests-list') }}"><i class="fa fa-angle-right"></i><span> Requests </span></a></li>
            </ul>
        </li>
        <li>
            <a href="users"> <i class="fa fa-area-chart"></i> <span>Statistics And Reports</span></a>
            <ul>
                <li><a href=""><i class="fa fa-angle-right"></i><span> List </span></a></li>
                <li><a href=""><i class="fa fa-angle-right"></i><span>Add</span></a></li>
            </ul>
        </li>
        <li>
            <a href="{{route('contacts-list')}}"> <i class="fa fa-book"></i> <span>Contacts</span></a>
        </li>


    </ul>

</div>