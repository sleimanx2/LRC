<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <h4>General Information</h4>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Name</label>
                    {!! Form::text('name', old('name'), ['class' =>
                    'form-control','pattern'=>'.{2,}','require'=>'','title'=>'2 characters minimum']) !!}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Phone Numbers</label>
                    {!! Form::text('phone_numbers', old('phone_numbers'), ['class' => 'form-control tagsinput', 'required']) !!}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Category</label>
                    {!! Form::select('category_id', $categories->prepend('', ''), old('category_id'), ['class' => 'form-control category-select']) !!}
                </div>
            </div>

            <div id="fields_medicalCenters" style="{{ (isset($contact) && in_array($contact->category_id, [1, 2, 3])) ? '' : 'display: none' }}">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Nickname</label>
                        {!! Form::text('nickname', old('nickname'), ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Sector</label>
                        {!! Form::text('sector', old('sector'), ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>
            </div>

            <div id="fields_lrcCenters" style="{{ (isset($contact) && $contact->category_id == 4) ? '' : 'display: none' }}">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="">Ambulances</label>
                        {!! Form::text('ambulances', old('ambulances'), ['class' => 'form-control tagsinput']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Sector</label>
                        {!! Form::text('sector', old('sector'), ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>
            </div>

            <script>
                $(".category-select").on("select2:select", function (e) {
                    $("#fields_medicalCenters").hide();
                    $("#fields_lrcCenters").hide();

                    if(e.params.data.id == 1 || e.params.data.id == 2 || e.params.data.id == 3)
                        $("#fields_medicalCenters").show();

                    else if(e.params.data.id == 4)
                        $("#fields_lrcCenters").show();
                });
            </script>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Is Favorite</label>
                    <label class="ui-checkbox ui-block" for="">
                    {!! Form::checkbox('favorite', null, old('favorite')) !!}
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
                @include('partials.location')
                <div class="form-group">
                    <div class="ui-map" id="map-canvas"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-success m-r-sm">SAVE</button>
<a href="{{ route('contacts-list') }}" class="btn btn-default">CANCEL</a>