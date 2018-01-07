@extends('layouts.manage')

@section('content')
<div class="user-manage-tile">
    User Management
</div>
<hr>
<div class="search-create-user m-bottom-20">
    <div class="columns">
        <div class="column is-2">
            <a href="{{ route('user.create') }}" class="button is-link"><i class="fa fa-user-plus m-right-5" aria-hidden="true"></i>Create User</a>
        </div>
        <div class="column is-offset-6 is-4">
            <form action="{{ route('admin.user.search') }}" method="POST">
                {{ csrf_field() }}
                <div class="field has-addons">
                    <div class="control">
                        <input type="text" class="input" name="search_value" placeholder="Id/Username/Email">
                    </div>
                    <div class="control">
                        <button class="button is-link">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="user-info-table">
    <table class="table is-hoverable">
        <thead>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Gender</th>
            <th>User Email</th>
            <th>Register Date</th>
            <th>Is Active</th>
            <th>Is Ban</th>
            <th>Role</th>
            <th>view</th>
            <th>Block</th>
        </tr>
        </thead>
        <tbody>
        @if($users->count() > 0)
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->gender }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->toFormattedDateString() }}</td>
                    <td>{{ ($user->userActive->isActive) ? "True" : "False" }}</td>
                    <td>{{ ($user->userActive->isBan) ? "True" : "False" }}</td>
                    <td>{{ $user->roles()->first()['name'] }}</td>
                    <td><a href="{{ route('user.show',$user->id) }}" class="button is-primary">
                            <i class="fa fa-user" aria-hidden="true"></i></a></td>
                    <td><form action="{{ route('admin.user.block',$user) }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="userID" value={{ $user->id }}>
                            <button class="button is-danger" {{ ($user->hasRole(['admin','superadmin'])? "disabled" : '' ) }}>
                                @if (!$user->userActive->isBan)
                                    <i class="fa fa-ban" aria-hidden="true"></i>
                                @else
                                    <i class="fa fa-unlock" aria-hidden="true"></i>
                                @endif
                            </button>
                        </form></td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
{{ $users->links() }}
@endsection

@section('js')
    @include('inc.messages.message')
@endsection