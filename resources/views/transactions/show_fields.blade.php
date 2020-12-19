<!-- User Or Merchant Id Field -->
<div class="form-group">
    {!! Form::label('user_or_merchant_id', 'User Or Merchant Id:') !!}
    <p>{{ $transaction->user_or_merchant_id }}</p>
</div>

<!-- Reciever Id Field -->
<div class="form-group">
    {!! Form::label('reciever_id', 'Reciever Id:') !!}
    <p>{{ $transaction->reciever_id }}</p>
</div>

<!-- Amount Field -->
<div class="form-group">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{{ $transaction->amount }}</p>
</div>

<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $transaction->type }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $transaction->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $transaction->updated_at }}</p>
</div>

