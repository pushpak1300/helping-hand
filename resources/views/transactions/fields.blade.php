<!-- User Or Merchant Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_or_merchant_id', 'User Or Merchant Id:') !!}
    {!! Form::select('user_or_merchant_id', ], null, ['class' => 'form-control']) !!}
</div>

<!-- Reciever Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reciever_id', 'Reciever Id:') !!}
    {!! Form::select('reciever_id', ], null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::select('type', ], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Cancel</a>
</div>
