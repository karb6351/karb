@extends('layouts.manage')

@section('content')
    <div class="user-manage-tile">
        User Management
    </div>
    <hr>

    <div class="columns">
        <div class="column is-2">
            <a href="{{ route('user.index') }}" class="button is-link"><i class="fa fa-arrow-circle-o-left m-right-5"></i>Back to index</a>
        </div>
    </div>
       <div class="create-user">
            <div class="card-header-title create-user-header column is-10">Create User</div>
            <form id="create-user-form" action="{{ route('user.store') }}" method="post">
                {{ csrf_field() }}
                <div class="column is-6">
                    <div class="columns">

                        <div class="column is-12">
                            <b-field label="Username">
                                <b-input type="text" name="username" required></b-input>
                            </b-field>
                        </div>

                        {{--<div class="column is-4" v-cloak>--}}
                            {{--<b-field label="Role">--}}
                                {{--<b-select name="role" placeholder="Select a Role" required>--}}
                                    {{--<option--}}
                                            {{--v-for="role in roles"--}}
                                            {{--:value="role.id"--}}
                                            {{--:key="role.id">--}}
                                        {{--@{{ role.name }}--}}
                                    {{--</option>--}}
                                {{--</b-select>--}}
                            {{--</b-field>--}}
                        {{--</div>--}}

                    </div>
                    <div class="columns">
                        <div class="column is-12">
                            <b-field label="Email">
                                <b-input type="email" name="email" placeholder="example@test.com" required></b-input>
                            </b-field>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column is-6">
                            <b-field label="Password">
                                <b-input type="password" name="password" :disabled="isChecked" :required="!isChecked" minlength="6"></b-input>
                            </b-field>
                        </div>
                        <div class="column is-6">
                            <b-field label="Confirm Password">
                                <b-input type="password" name="password_confirmation" :disabled="isChecked" :required="!isChecked" minlength="6"></b-input>
                            </b-field>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                            <label for="gender" class="label">Gender</label>
                            <b-radio name="gender" v-model="gender"
                                     native-value="male">
                                Male
                            </b-radio>
                            <b-radio name="gender" v-model="gender"
                                     native-value="female">
                                Female
                            </b-radio>
                        </div>
                    </div>

                    <div class="columns column is-12">
                        <button class="button is-link m-right-20"><i class="fa fa-check-circle-o m-right-5" aria-hidden="true"></i></i>Submit</button>
                        <b-checkbox name="autoGenPW" :native-value="isChecked" v-model="isChecked" >Auto Generate Password</b-checkbox>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var app = new Vue({
            el: '#create-user-form',
            data:{
                isChecked : true,
                gender: "male",
                roles: {!! json_encode($roles) !!}
            }
        })
    </script>
@endsection
