@extends('layouts.master')

@section('sub-header')
<div class="clearfix">
    <h5 class="page-title">Manage Users</h5>
    <ul class="list-unstyled toolbar pull-right">
        <li><a href="/register" class="btn btn-action btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Create User</a></li>
        <li>
            <form class="form-inline ng-pristine ng-valid" role="form" method="GET" action="{{ route('users-list') }}">
                <div class="form-group">
                    <input type="text" name="search" value="{{ Request::get('search') }}" placeholder="Search..." class="form-control ng-pristine ng-valid">
                </div>
                <div class="form-group">
                <span>
                    <button type="submit" class="btn btn-light"><i class="fa fa-search"></i></button>
                </span>
                </div>
            </form>
        </li>
    </ul>
</div>
@endsection

@section('content')
    <div class="page">
        <section class="panel panel-default table-dynamic">
            <div class="panel panel-default">
                @if(!$sysUsers->count())
                    <div class="alert alert-warning">No users found!</div>
                @else
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Username</th>
                            <th>Nickname</th>
                            <th>Location</th>
                            <th>Login Allowed</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sysUsers as $user)
                            @if($user->id != 1)
                            <tr>
                                <td><a href="{{ route('user-edit', [$user->id]) }}"><b>{{ $user->last_name }}</b></a></td>
                                <td><a href="{{ route('user-edit', [$user->id]) }}"><b>{{ $user->first_name }}</b></a></td>
                                <td>{{ $user->username }}</td>
                                <td>
                                    @if($user->nickname)
                                    <span class="label label-info">{{ $user->nickname }}</span>
                                    @else 
                                    <span class="label label-none">None</span>
                                    @endif
                                </td>
                                <td>{{ $user->location }}</td>
                                <td>
                                    @if($user->is_active)
                                    <span class="label label-success">Yes</span>
                                    @else 
                                    <span class="label label-danger">No</span>
                                    @endif
                                </td>
                                <td>
                                    @if(!$user->is_admin)
                                    <a class="btn btn-info btn-sm" href="{{ route('user-edit',[$user->id]) }}" popover="Edit" popover-trigger="mouseenter"><i class="fa fa-edit "></i></a>

                                    {{-- 

                                    {!!Form::open([
                                        'method'=>'delete',
                                        'route'=>['user-destroy',$user->id],
                                        'style'=>'display:inline',
                                        'onsubmit'=>'return confirm("Are you sure you want to delete '.$user->first_name.'
                                        '.$user->last_name.' ?");'
                                    ]) !!}

                                    <button type="submit" class="btn btn-danger btn-sm hidden-xs" popover="Delete" popover-trigger="mouseenter"><i class="fa fa-remove"></i></button>
                                    {!!Form::close()!!} 

                                    --}}
                                    @endif
                                </td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                @endif
                <div class="col-md-12  ">
                <span class="pull-right">
                    <?php echo $sysUsers->appends(Request::except('page'))->render() ?>
                </span>
                </div>
        </section>
    </div>
@endsection
