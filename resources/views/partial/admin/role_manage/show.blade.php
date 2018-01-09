@extends('layouts.manage')

@section('content')
    <div class="role-manage-tile">
        Role Management
    </div>
    <div class="columns">
        <div class="column is-7">
            <div class="show-role-info">
                <div class="show-role-header">
                    Role Detail
                    <div class="role-tool">
                        <div class="buttons has-addons">
                            <a href="{{ route('role.index') }}" class="button is-primary">
                                <i class="fa fa-arrow-circle-left m-right-5" aria-hidden="true"></i>Back to index</a>
                            <a href="{{ route('role.edit',$role->id) }}" class="button">
                                <i class="fa fa-pencil-square-o m-right-5" aria-hidden="true"></i>Edit Role</a>
                        </div>
                    </div>
                </div>
                <div class="show-role-content">
                    <div class="column is-12">
                        <div class="card">
                            <div class="card-content">
                                <b-tabs  v-cloak>
                                    <b-tab-item label="Information">
                                        <div class="column is-12 role-info">
                                            <dl>
                                                <dt>Name:</dt>
                                                <dd><strong class="m-left-40">{{ $role->name }}</strong></dd>
                                                <dt>Permission:</dt>
                                                <dd><ol class="m-left-50">
                                                        @foreach($role->permissions as $permission)
                                                            <li><strong>{{ $permission->name }}</strong></li>
                                                        @endforeach
                                                    </ol></dd>
                                            </dl>
                                        </div>
                                    </b-tab-item>

                                    <b-tab-item label="User">
                                        <div class="column is-12 role-user">
                                            <table class="table is-fullwidth">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($role->users as $user)
                                                    <tr>
                                                        <td>{{ $user->id }}</td>
                                                        <td>{{ $user->username }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </b-tab-item>
                                </b-tabs>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    @include('inc.messages.message')
    <script>
        new Vue({
            el: '.show-role-info',
        })
    </script>
@endsection