<div class="form-group">
    {!! Form::text('name', old('name'),['class' => 'form-control','placeholder'=>'Casualty name']) !!}
</div>
{!! Form::hidden('emergency_id', $emergency->id) !!}
{!! Form::submit('Save',['class'=>'btn btn-primary']) !!}