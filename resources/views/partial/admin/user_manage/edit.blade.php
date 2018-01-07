@extends('layouts.manage')

@section('content')
    <div class="user-manage-tile">
        User Management
    </div>
    <hr>
    <div class="columns">
        <div class="column is-2">
            <a href="{{ route('user.show',$user->id) }}" class="button is-link"><i class="fa fa-arrow-circle-o-left m-right-5"></i>User info</a>
        </div>
    </div>
    <div class="create-user">
        <div class="card-header-title create-user-header column is-10">Edit User</div>
        <form id="edit-user-form" method="post" action="{{ route('user.update' ,$user->id) }}">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="columns">
                <div class="column is-6">
                    <div class="columns">
                        <div class="column is-8">
                            <b-field label="Username">
                                <b-input type="text" name="username" value="{{ $user->username }}" required></b-input>
                            </b-field>
                        </div>

                        <div class="column is-4" v-cloak>
                            <label for="role" class="label">Role</label>
                            <input name="role" type="text" class="input is-static" value="{{ $user->roles()->first()['name'] }}" readonly>
                        </div>

                    </div>
                    <div class="columns">
                        <div class="column is-12">
                            <b-field label="Email">
                                <b-input type="email" name="email" placeholder="example@test.com" required value="{{ $user->email }}"></b-input>
                            </b-field>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column is-6">
                            <b-field label="Password">
                                <b-input type="password" name="password" :disabled="!isManual" :required="isManual" minlength="6"></b-input>
                            </b-field>
                        </div>
                        <div class="column is-6">
                            <b-field label="Confirm Password">
                                <b-input type="password" name="password_confirmation" :disabled="!isManual" :required="isManual" minlength="6"></b-input>
                            </b-field>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                            <label for="gender" class="label">Gender</label>
                            <b-radio name="gender" v-model="gender"
                                     native-value="male" >
                                Male
                            </b-radio>
                            <b-radio  name="gender" v-model="gender"
                                      native-value="female">
                                Female
                            </b-radio>
                        </div>
                    </div>

                    <div class="columns column is-12">
                        <button type="submit" class="button is-link m-right-20"><i class="fa fa-check-circle-o m-right-5" aria-hidden="true"></i></i>Submit</button>
                    </div>
                </div>
                <div class="column is-6">
                    <label class="label">Password choice</label>
                    <div class="field">
                        <b-radio name="pw_choice" v-model="password_choice"
                                 native-value="remain">
                            Remain the old password
                        </b-radio>
                    </div>
                    <div class="field">
                        <b-radio name="pw_choice" v-model="password_choice"
                                 native-value="auto">
                            Auto generate a new password
                        </b-radio>
                    </div>
                    <div class="field">
                        <b-radio name="pw_choice" v-model="password_choice"
                                 native-value="manual">
                            Fill the password manually
                        </b-radio>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
@endsection

@section('js')
    <script>
        var form = new Vue({
            el: '#edit-user-form',
            data:{
                password_choice: "remain",
                gender: "{!! $user->gender !!}",
                selected: {!! $user->roles()->first()['id'] !!},
            },
            computed:{
                isManual : function(){
                    return (this.password_choice == "manual");
                }
            }
        })
    </script>
@endsection
