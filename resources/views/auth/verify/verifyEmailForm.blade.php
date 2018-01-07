@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="columns">
            <div class="column is-offset-3 is-6 verify-message m-top-40">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Send the verify email
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            <form action={{ route('sendVerifyForm') }} method="POST" role="form">
                                {{ csrf_field() }}
                                <div class="field">
                                    <label for="email" class="label">Email Address</label>
                                    <input type="email" class="input" name="email" placeholder="example@example.com" required>
                                </div>
                                <button type="submite"class="button is-info">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
