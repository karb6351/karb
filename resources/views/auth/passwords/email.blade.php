@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns m-top-50">
        <div class="column is-offset-4 is-4 is-mobile">
            <div class="card-content">
                <h1 class="title">Reset Password</h1>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
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

                    <button type="submit" class="button is-info is-outlined is-fullwidth m-top-20">
                        Send Password Reset Link
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
