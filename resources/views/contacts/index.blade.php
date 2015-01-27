@extends('layouts.master')

@section('content')
    <div class="page">
        <section class="panel panel-default table-dynamic">
            <div class="panel panel-default">
                <div class="panel-heading"><strong><i class="fa fa-list panel-ico"></i>List of system contacts</strong>
                </div>
                <div class="table-filters">
                    <div class="row">
                        <div class="col-sm-5 hidden-xs pull-right">
                            <a href="{{ route('contact-create') }}" class="btn btn-success btn-width-long pull-right">
                                Add a contact <i class="fa fa-plus-circle"></i>
                            </a>
                        </div>
                        <div class="col-sm-7">
                            <form class="form-inline ng-pristine ng-valid" role="form" method="GET"
                                  action="{{ route('contacts-list') }}">

                                <div class="form-group">
                                    <input type="text" name="search" value="{{ Request::get('search') }}"
                                           placeholder="Search contacts"
                                           class="form-control ng-pristine ng-valid">
                                </div>
                                <div class="form-group">
                                    {!! Form::select('category', ['All','Categorised'=>$categories] ,
                                    Request::get('category') , ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                <span>
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if(!$contacts->count())
                <div class="alert alert-warning">No result found !</div>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th class="hidden-xs">Category</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{$contact->name}}</td>
                            <td>{{$contact->phone_primary}}</td>
                            <td class="hidden-xs"> {{$contact->category->name}} </td>
                            <td>
                                <a class="btn btn-info btn-xs" href="{{ route('contact-edit',[$contact->id]) }}"
                                   popover="Edit" popover-trigger="mouseenter"><i
                                            class="fa fa-edit "></i></a>
                                {!!Form::open([
                                'method'=>'delete',
                                'route'=>['contact-destroy',$contact->id],
                                'style'=>'display:inline',
                                'onsubmit'=>'return confirm("Are you sure you want to delete '.$contact->name.' ?");'
                                ]) !!}

                                <button type="submit" class="btn btn-danger btn-xs hidden-xs" popover="Delete"
                                        popover-trigger="mouseenter"><i
                                            class="fa fa-remove"></i>
                                </button>

                                {!!Form::close()!!}

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
            <div class="col-md-12  ">
                <span class="pull-right">
                    <?php echo $contacts->appends(Request::except('page'))->render() ?>
                </span>
            </div>
        </section>
    </div>
@endsection
