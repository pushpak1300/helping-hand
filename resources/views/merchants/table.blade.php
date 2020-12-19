<div class="table-responsive-sm">
    <table class="table table-striped" id="merchants-table">
        <thead>
            <tr>
                <th>Shop Name</th>
        <th>City</th>
        <th>Shop Type</th>
        <th>User Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($merchants as $merchant)
            <tr>
                <td>{{ $merchant->shop_name }}</td>
            <td>{{ $merchant->city }}</td>
            <td>{{ $merchant->shop_type }}</td>
            <td>{{ $merchant->user_id }}</td>
                <td>
                    {!! Form::open(['route' => ['merchants.destroy', $merchant->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('merchants.show', [$merchant->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('merchants.edit', [$merchant->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>