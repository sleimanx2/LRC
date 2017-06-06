<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <h4>Personal Information</h4>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">First Name</label>
                    {!! Form::text('first_name', old('first_name'), ['class' => 'form-control format-title-case auto-generate-seed', 'required']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Last Name </label>
                    {!! Form::text('last_name', old('last_name'), ['class' => 'form-control format-title-case auto-generate-seed', 'required']) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Username </label>
                    {!! Form::text('username', old('username'), ['class' => 'form-control', 'readonly']) !!}
                </div>
            </div>
            <div class="col-md-7">
                <div class="form-group">
                    <label for="">Email</label>
                    {!! Form::email('email', old('email') , ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Nickname</label>
                    {!! Form::text('nickname', old('nickname'), ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Promo</label>
                    {!! Form::text('promo', old('promo'), ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Phone Numbers</label>
                    {!! Form::text('phone_numbers', old('phone_numbers'), ['class' => 'form-control tagsinput', 'required']) !!}
                </div>
            </div>
        </div>

        <hr/>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Roles</label>
                    {!! Form::select('roles_ids[]', $roles, old('roles_ids'), ['multiple']) !!}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Is Active</label>
                    <label class="ui-checkbox ui-block" for="">
                    {!! Form::checkbox('is_active', null, old('is_active')) !!}
                    <span></span>
                    </label>
                </div>
            </div>
        </div> 
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <h4>Location Information</h4>
            </div>

            <div class="col-md-12">
                {{-- Location Field --}}
                @include('partials.location')
                {{-- End Location Field --}}

                <div class="form-group">
                    <div class="ui-map" id="map-canvas"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Notes</label>
                    {!! Form::textarea('note', old('note'), ['class' => 'form-control autogrow']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-success m-r-sm">SAVE</button>
<a href="{{ route('users-list') }}" class="btn btn-default">CANCEL</a>
