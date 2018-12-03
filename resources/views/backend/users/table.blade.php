<table class="table table-bordered table-condesed">
    <thead>
        <tr>
            <th>Action</th>
            <th>Email</th>
            <th>User Name</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td width="70">
                    <a title="Edit" class="btn btn-xs btn-default edit-row" href="{{ route('users.edit', ['user' => $user->id]) }}">
                        <i class="fa fa-edit"></i>
                    </a>
                    @if($user->id == config('cms.default_user_id') || $user->id == auth()->user()->id)
                        <form action="{{route('users.confirm_delete', ['user' => $user->id])}}" method="GET" style="display: inline;">
                            @csrf
                            <button disabled type="submit" title="Delete Permanent" class="btn btn-xs btn-danger delete-row">
                                <i class="fa fa-times"></i>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('users.confirm_delete', ['user' => $user->id]) }}" title="Delete Permanent" class="btn btn-xs btn-danger delete-row">
                            <i class="fa fa-times"></i>
                        </a>
                    @endif
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->roles->first()->display_name }}</td>
            </tr>
            @endforeach
    </tbody>
</table>