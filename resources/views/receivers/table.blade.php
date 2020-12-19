<div class="table-responsive-sm">
    <table class="table table-striped" id="receivers-table">
        <thead>
            <tr>
                <th>Age</th>
        <th>Created By</th>
        <th>User Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($receivers as $receiver)
            <tr>
                <td>{{ $receiver->age }}</td>
            <td>{{ $receiver->created_by }}</td>
            <td>{{ $receiver->user_id }}</td>
                <td>
                    {!! Form::open(['route' => ['receivers.destroy', $receiver->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('receivers.show', [$receiver->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('receivers.edit', [$receiver->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>