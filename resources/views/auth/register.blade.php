@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns m-top-50">
        <div class="column is-offset-4 is-4 is-mobile">
            <div class="card-content">
                <h1 class="title">Register</h1>
                <form method="POST" action="{{ route('register') }}" role="form">
                    {{ csrf_field() }}
                    <div class="field m-top-30">
                        <label for="email" class="label">Email Address</label>
                        <p class="control">
                            <input type="email" class="input {{$errors->has('email')? 'is-danger': ''}}" name="email" placeholder="example@test.com" required>
                        </p>
                        @if ($errors->has('email'))
                            <p class="help is-danger">{{$errors->first('email')}}</p>
                        @endif
                    </div>
                    <div class="columns">
                        <div class="column is-7 field">
                            <label for="username" class="label">Username</label>
                            <p class="control">
                                <input type="text" class="input {{$errors->has('Username')? 'is-danger': ''}}" name="username" required>
                            </p>
                            @if ($errors->has('username'))
                                <p class="help is-danger">{{$errors->first('username')}}</p>
                            @endif
                        </div>
                        <div class="column is-5 field">
                            <label for="gender" class="label">Gender</label>
                            <div class="control has-icons-left">

                                <div class="select is-rounded" name="gender">
                                    <select name="gender">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                <div class="icon is-small is-left">
                                    <i class="fa fa-transgender" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column is-6 field">
                            <label for="password" class="label">Password</label>
                            <p class="control">
                                <input type="password" class="input {{$errors->has('password')? 'is-danger': ''}}" name="password" required>
                            </p>
                            @if ($errors->has('password'))
                                <p class="help is-danger">{{$errors->first('password')}}</p>
                            @endif
                        </div>

                        <div class="column is-6 field">
                            <label for="password_confirmation" class="label">Confirm password</label>
                            <p class="control">
                                <input type="password" class="input {{$errors->has('password_confirmation')? 'is-danger': ''}}" name="password_confirmation" placeholder="Enter your password again" required>
                            </p>
                            @if ($errors->has('password_confirmation'))
                                <p class="help is-danger">{{$errors->first('password_confirmation')}}</p>
                            @endif
                        </div>
                    </div>


                    <button class="button is-info is-outlined is-fullwidth m-top-20">Register</button>
                </form>
            </div>
        </div>
    </div>
    <h5 class="register has-text-centered m-top-20">
        <a class="is-muted" href="{{ route('login') }}">
            Already has a account?
        </a>
    </h5>
    <h5 class="register has-text-centered m-top-20">
        <a class="is-muted" href="{{ route('getVerifyForm') }}">
            Don't receive the verify email?
        </a>
    </h5>
</div>
@endsection
