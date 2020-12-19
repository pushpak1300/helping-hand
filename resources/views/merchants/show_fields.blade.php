<!-- Shop Name Field -->
<div class="form-group">
    {!! Form::label('shop_name', 'Shop Name:') !!}
    <p>{{ $merchant->shop_name }}</p>
</div>

<!-- City Field -->
<div class="form-group">
    {!! Form::label('city', 'City:') !!}
    <p>{{ $merchant->city }}</p>
</div>

<!-- Shop Type Field -->
<div class="form-group">
    {!! Form::label('shop_type', 'Shop Type:') !!}
    <p>{{ $merchant->shop_type }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $merchant->user_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $merchant->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $merchant->updated_at }}</p>
</div>

