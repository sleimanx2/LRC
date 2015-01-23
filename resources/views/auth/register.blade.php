@extends('layouts.master')

@section('content')
    <div class="page page-form ng-scope">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 ng-scope" data-ng-controller="userRegisterFormCtrl">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong><i class="fa fa-pencil panel-ico"></i>Register a first
                            aider</strong>
                    </div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form name="user_register_form" role="form" method="POST"
                              action="/auth/register">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label for="">First Name</label>
                                <input type="text" value="{{ old('first_name') }}" name="first_name"
                                       class="form-control" pattern=".{2,}" required title="2 characters minimum">
                            </div>
                            <div class="form-group">
                                <label for="">Last Name </label>
                                <input type="text" value="{{ old('last_name') }}" name="last_name" class="form-control"
                                       pattern=".{2,}" required title="2 characters minimum">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" value="{{old('email')}}" name="email" class="form-control"
                                       required="">
                                <span></span>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Password</label>
                                        <input type="password" name="password"
                                               class="form-control ng-pristine ng-invalid ng-invalid-required"
                                               pattern=".{6,16}" required
                                               title="6 characters minimum and 16 characters maximum"
                                               name="type_something" data-ng-trim="false"
                                               data-ng-model="form.password">
                                        <span></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Confirm Password</label>
                                        <input type="password" name="password_confirmation"
                                               class="form-control ng-pristine ng-invalid ng-invalid-required ng-invalid-equal"
                                               required="true" name="confirm_type" data-ng-trim="false"
                                               data-ng-model="form.password_confirm"
                                               data-validate-equals="form.password">
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Phone Primary</label>
                                <input type="number" name="phone_primary" value="{{old('phone_primary')}}"
                                       class="form-control" pattern=".{8,8}" required
                                       title="The number should contain 8 digits">
                                <span></span>
                            </div>
                            <div class="form-group">
                                <label for="">Phone Secondary</label>
                                <input type="number" name="phone_secondary" value="{{old('phone_secondary')}}"
                                       class="form-control" pattern=".{8,8}" title="The number should contain 8 digits">
                            </div>
                            <hr/>
                            <div class="form-group">
                                <input type="hidden" ng-value="form.location" name="location"
                                       value="{{old('location')}}" class="form-control" required=""
                                       data-ng-model="form.location">
                                <google-places location=location></google-places>
                            </div>
                            <div class="form-group">
                                <input type="hidden" ng-value="form.latitude" name="latitude" class="form-control"
                                       data-ng-model="form.latitude">
                                <input type="hidden" ng-value="form.longitude" name="longitude" class="form-control"
                                       data-ng-model="form.longitude">
                            </div>

                            <div class="form-group">
                                <div class="ui-map" id="map-canvas"></div>
                            </div>
                            <hr/>
                            <button type="submit" class="btn btn-success">
                                Register
                            </button>
                            <button class="btn btn-default" data-ng-disabled="!canRevert()" data-ng-click="revert()"
                                    disabled="disabled">Revert Changes
                            </button>

                        </form>

                    </div>
                </div>
            </div>
@endsection
