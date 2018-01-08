@extends('layouts.manage')

@section('content')
    <div class="columns">
        <div class="column is-7">
            <div class="assign-role" id="assign-role">
                <div class="assign-role-header">
                    Assign Role
                </div>
                <div class="assign-role-content m-top-20">
                    <form action="{{ route('admin.role.assign') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="columns">
                            <div class="column is-4">
                                <b-field label="Role">
                                    <b-select name="role" placeholder="Select a role" required v-cloak>
                                        <option  v-for="role in roles" :value="role.id" :key="role.id">@{{ role.name }}</option>
                                    </b-select>
                                </b-field>
                            </div>
                            <div class="column is-4">
                                <b-field label="Search User">
                                    <b-input type="text" v-model="search" placeholder="Email/Username"></b-input>
                                </b-field>
                            </div>
                            <div class="column is-4 m-top-30">
                                <button type="submit" class="button is-primary">Submit</button>
                            </div>
                        </div>
                        <div class="columns asign-user-table">
                            <div class="column is-12">
                                <table class="table is-fullwidth is-hoverable ">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="user in filterUsers" v-cloak>
                                            <td>@{{ user.id }}</td>
                                            <td>@{{ user.username }}</td>
                                            <td>@{{ user.email }}</td>
                                            <td>@{{ user.gender }}</td>
                                            <td><b-checkbox name="users[]" v-model="assignRole"
                                                            :native-value="user.id" required>
                                                </b-checkbox></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="column is-5 m-top-50">
            <div class="card ">
                <div class="card-header">
                    <span class="card-header-title">
                        <span class="is-pulled-left">Role</span>
                    </span>
                    <a href="{{ route('role.create') }}" class="button is-primary m-top-6 m-right-6">
                        <i class="fa fa-plus m-right-5" aria-hidden="true"></i>
                        Add
                    </a>
                </div>
                <div class="card-content">
                    <table class="table is-fullwidth is-hoverable ">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>More</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td><button class="button is-link"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button></td>
                                <td><button class="button is-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('inc.messages.message')
    <script>
        var test = new Vue({
            el: "#assign-role",
            data: {
                roles : {!! json_encode($roles) !!},
                users:{!! json_encode($users) !!},
                search: '',
                assignRole: [],
            },
            computed:{
                filterUsers : function(){
                    return this.users.filter( (user) => {
                        return (user.username.toLowerCase().match(this.search) ||
                        user.email.toLowerCase().match(this.search))
                    });
                }
            }
        })
    </script>
    @endsection