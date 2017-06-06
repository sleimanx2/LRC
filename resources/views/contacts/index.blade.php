@extends('layouts.master')

@section('sub-header')
<div class="clearfix">
    <h5 class="page-title">Manage Contacts</h5>
    <ul class="list-unstyled toolbar pull-right">
        <li><a href="{{ route('contact-create') }}" class="btn btn-action btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Create Contact</a></li>
        <li>
            <form class="form-inline ng-pristine ng-valid" role="form" method="GET" action="{{ route('contacts-list') }}">
                <div class="form-group">
                    {!! Form::select('category', $categories->prepend("All"), Request::get('category'), ['class' => 'form-control select2-fixed-width auto-search']) !!}
                </div>
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
            

            @if(!$contacts->count())
                <div class="alert alert-warning">No result found !</div>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th class="hidden-xs">Category</th>
                        <th>Favorite</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Phone Numbers</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td class="hidden-xs"> {{$contact->category->name}} </td>
                            <td>{!! Html::favorite($contact->favorite) !!}</td>
                            <td>{{$contact->name}}</td>
                            <td>{{$contact->location}}</td>
                            <td>{!! Html::phone_numbers($contact->phone_numbers) !!}</td>
                            <td>
                                <a class="btn btn-info btn-sm" href="{{ route('contact-edit',[$contact->id]) }}"
                                   popover="Edit" popover-trigger="mouseenter"><i
                                            class="fa fa-edit "></i></a>

                                {{-- 
                                {!!Form::open([
                                'method'=>'delete',
                                'route'
                                =>['contact-destroy',$contact->id],
                                'style'=>'display:inline',
                                'onsubmit'=>'return confirm("Are you sure you want to delete '.$contact->name.' ?");'
                                ]) !!}

                                <button type="submit" class="btn btn-danger btn-xs hidden-xs" popover="Delete"
                                        popover-trigger="mouseenter"><i
                                            class="fa fa-remove"></i>
                                </button>

                                --}}

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
