@extends('layouts.manage')

@section('content')
    <div class="columns">
        <div class="column is-7">
            <div class="show-role-info">
                <div class="show-role-header">
                    Edit Role
                    <div class="role-tool">
                        <div class="buttons has-addons">
                            <a href="{{ route('role.index') }}" class="button is-primary">
                                <i class="fa fa-arrow-circle-left m-right-5" aria-hidden="true"></i>Back to index</a>
                            <a href="{{ route('role.show',$role->id) }}" class="button">
                                <i class="fa fa-ban m-right-5" aria-hidden="true"></i>Cancel</a>
                        </div>
                    </div>
                </div>
                <div class="show-role-content">
                    <div class="column is-12">
                        <div class="column is-12 role-info">
                            <form action="{{ route('role.update',$role->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field("put") }}
                                <div class="column is-12">
                                    <b-field label="Name">
                                        <b-input value="{{ $role->name }}"></b-input>
                                    </b-field>
                                    <b-field label="Permission">
                                        <div class="column is-12 permission-choice">
                                            <b-checkbox v-model="selectedPermission"
                                                        v-for="permission in permissions"
                                                        :native-value="permission.id"
                                                        :key="permission.id"
                                                        class="column is-12" v-cloak>
                                                @{{ permission.name }}
                                            </b-checkbox>
                                        </div>

                                    </b-field>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        new Vue({
            el: '.show-role-info',
            data:{
                selectedPermission: {!! ($role->permissions) !!},
                permissions: {!! ($permissions) !!}
            }
        })
    </script>
@endsection