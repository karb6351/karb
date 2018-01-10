@extends('layouts.manage')

@section('content')
    <div class="permission-manage-tile">
        Permission Management
    </div>
    <div class="columns" id="permission-info">
        <div class="column is-6">
            <div class="columns">
                <div class="column is-6">
                    <input type="text" class="input" v-model="search" placeholder="Permission name">
                </div>
            </div>
            <table class="table is-hoverable is-fullwidth" id="permissionTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="permission in searchPermission" :key="permission.id" v-cloak>
                    <th id="permissionID">@{{ permission.id }}</th>
                    <th><input type="text" class="input " :class="{ 'is-static': isActive }" :value=" permission.name " ></th>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="column is-5">
            <div class="card">
                <div class="card-header">
                    <p class="card-header-title">
                        Create Permission
                    </p>
                </div>
                <div class="card-content">
                    <form action="{{ route('permission.store') }}" method="post">
                        {{ csrf_field() }}
                        <b-field label="Name" message="{{$errors->has('name')? $errors->first('name'): ''}}"
                                 type="{{$errors->has('name')? 'is-danger': ''}}">
                            <input type="text" class="input " name="name">
                        </b-field>
                        <button class="button is-link">Create</button>
                    </form>
                </div>
            </div>
            <div class="card m-top-20" >
                <div class="card-header">
                    <p class="card-header-title">
                        Update Permission
                    </p>
                </div>
                <div class="card-content">
                    <form action="{{ route('permission.update') }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field("put") }}
                        <b-field label="Permission" message="{{$errors->has('permissionID')? $errors->first('permissionID'): ''}}"
                                 type="{{$errors->has('permissionID')? 'is-danger': ''}}" v-cloak>
                            <b-select name="permissionID" placeholder="Select a permission">
                                <option v-for="permission in permissions"
                                        :value="permission.id"
                                        :key="permission.id">
                                    @{{ permission.name }}
                                </option>
                            </b-select>
                        </b-field>
                        <b-field label="Name" message="{{$errors->has('name')? $errors->first('name'): ''}}"
                                 type="{{$errors->has('name')? 'is-danger': ''}}">
                            <input type="text" class="input" name="name" >
                        </b-field>
                        <button class="button is-link">Edit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
    @include('inc.messages.message')
    <script>
        new Vue({
            el: "#permission-info",
            data:{
                search: '',
                permissions: {!! json_encode($permissions) !!},
                isActive : true,
                isCreateOpen: true,
                isEditOpen: true,
            },
            computed:{
                searchPermission : function(){
                    return this.permissions.filter( (permission) => {
                            return (permission.name.toLowerCase().match(this.search) )
                    });
                },
                permissionsLength: function(){
                    return this.permissions.length;
                }
            },
        })
    </script>
@endsection