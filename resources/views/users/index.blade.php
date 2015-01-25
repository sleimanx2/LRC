@extends('layouts.master')

@section('content')
    <div class="page">
        <section class="panel panel-default table-dynamic">
            <div class="panel panel-default">
                <div class="panel-heading"><strong><i class="fa fa-list panel-ico"></i>List of first aiders</strong>
                </div>
                <div class="table-filters">
                    <div class="row">
                        <form class="ng-pristine ng-valid" role="form" method="GET" action="{{ route('users-list') }}">
                            <div class="col-sm-5 hidden-xs pull-right">
                                <a href="/auth/register" class="btn btn-success btn-width-long pull-right">
                                    Register First Aider <i class="fa fa-plus-circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-4 col-xs-6">
                                <input type="text" name="search" value="{{ Request::get('search') }}"
                                       placeholder="Search first aider"
                                       class="form-control ng-pristine ng-valid">
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <span>
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @if(!$users->count())
                <div class="alert alert-warning">No result found !</div>
            @else

                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th class="hidden-xs">Email</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->first_name}} {{$user->last_name}}</td>
                            <td>{{$user->phone_primary}}</td>
                            <td class="hidden-xs"> {{$user->email}} </td>
                            <td>
                                <a class="btn btn-info btn-xs" href="{{ route('user-edit',[$user->id]) }}" popover="Edit" popover-trigger="mouseenter"><i
                                            class="fa fa-edit "></i></a>
                                <button class="btn btn-danger btn-xs hidden-xs" popover="Suspend"
                                        popover-trigger="mouseenter"><i
                                            class="fa fa-gavel"></i></button>
                                <button class="btn btn-danger btn-xs hidden-xs" popover="Delete"
                                        popover-trigger="mouseenter"><i
                                            class="fa fa-remove"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
            <div class="col-md-12  ">
                <span class="pull-right">
                    <?php echo $users->appends(Request::except('page'))->render() ?>
                </span>
            </div>
        </section>
    </div>
@endsection
