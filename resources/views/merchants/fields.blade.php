<!-- Shop Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('shop_name', 'Shop Name:') !!}
    {!! Form::text('shop_name', null, ['class' => 'form-control']) !!}
</div>

<!-- City Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city', 'City:') !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
</div>

<!-- Shop Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('shop_type', 'Shop Type:') !!}
    {!! Form::select('shop_type', ], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('merchants.index') }}" class="btn btn-secondary">Cancel</a>
</div>
