<div class="table-responsive-sm">
    <table class="table table-striped" id="transactions-table">
        <thead>
            <tr>
                <th>User Or Merchant Id</th>
        <th>Reciever Id</th>
        <th>Amount</th>
        <th>Type</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->user_or_merchant_id }}</td>
            <td>{{ $transaction->reciever_id }}</td>
            <td>{{ $transaction->amount }}</td>
            <td>{{ $transaction->type }}</td>
                <td>
                    {!! Form::open(['route' => ['transactions.destroy', $transaction->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('transactions.show', [$transaction->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('transactions.edit', [$transaction->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>