@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns m-top-50">
        <div class="column is-offset-4 is-4 is-mobile">
            <div class="card-content">
                <h1 class="title">Login</h1>

                <form id="login-form" method="POST" action="{{ route('login') }}" role="form">

                    {{ csrf_field() }}

                    <div class="field m-top-30">
                        <label for="email" class="label">Email Address</label>
                        <p class="control">
                            <input type="email" class="input {{$errors->has('email')? 'is-danger': ''}}" name="email" placeholder="example@test.com" value="{{old('email')}}" required>
                        </p>
                        @if ($errors->has('email'))
                            <p class="help is-danger">{{$errors->first('email')}}</p>
                        @endif
                    </div>

                    <div class="field">
                        <label for="password" class="label">Password</label>
                        <p class="control">
                            <input type="password" class="input {{$errors->has('password')? 'is-danger': ''}}" name="password" required>
                        </p>
                        @if ($errors->has('password'))
                            <p class="help is-danger">{{$errors->first('password')}}</p>
                        @endif
                    </div>

                    <div class="field m-top-30">
                        <b-checkbox type="is-info" name="remember">Remember me</b-checkbox>
                    </div>

                    <button class="button is-info is-outlined is-fullwidth m-top-20">Login</button>
                </form>
            </div>
        </div>
    </div>
    <h5 class="forget-password has-text-centered m-top-20">
        <a class="is-muted" href="{{ route('password.request') }}">
            Forgot Your Password?
        </a>
    </h5>
    <h5 class="register has-text-centered m-top-20">
        <a class="is-muted" href="{{ route('register') }}">
            Don't have a account?Click here to join us
        </a>
    </h5>
</div>
@endsection

@section('js')
    <script>
        new Vue({
            el: '#login-form'
        })
    </script>
@endsection
