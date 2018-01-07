@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns m-top-50">
        <div class="column is-offset-4 is-4">
            <div class="card-content">
                <h1 class="title">
                    Reset Password
                </h1>
                <form method="POST" action="{{ route('password.request') }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="field m-top-30">
                        <label for="email" class="label">Email Address</label>
                        <p class="control">
                            <input type="email" name="email" class="input {{$errors->has('email')? 'is-danger': ''}}" value="{{ $email or old('email') }}" required autofocus>
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

                    <div class="field">
                        <label for="password_confirmation" class="label">Confirm password</label>
                        <p class="control">
                            <input type="password" class="input {{$errors->has('password_confirmation')? 'is-danger': ''}}" name="password_confirmation" placeholder="Enter your password again" required>
                        </p>
                        @if ($errors->has('password_confirmation'))
                            <p class="help is-danger">{{$errors->first('password_confirmation')}}</p>
                        @endif
                    </div>

                    <button type="submit" class="button is-info is-outlined is-fullwidth m-top-20">
                        Reset Password
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
