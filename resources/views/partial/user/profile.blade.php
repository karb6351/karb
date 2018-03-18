@extends('layouts.app')

@section('title')
    Profile
@endsection

@section('content')
    <div id="profile" class="column is-4 is-offset-4 m-top-50">
        <div class="columns">
            <div class="column card">
                {{--profile image--}}
                @if(Auth::check() && Auth::user()->id == $user->id)
                <nav class="level">
                    <div class="level-left level-item">
                        <button class="button is-info is-outlined" @click="isEdit = !isEdit" v-cloak>
                            @{{ (isEdit)? "Cancel" : "Edit" }}
                        </button>
                    </div>
                    <div class="level-right level-item">
                        <button class="button is-success is-outlined" :class="{ notDisplay : !isEdit }" @click="editUser" v-cloak>
                            submit
                        </button>
                    </div>
                </nav>
                @endif
                <div class="card-content ">
                    <figure class="image is-128x128 profile-image">
                        <img src="{{"https://www.gravatar.com/avatar/" . md5(strtolower(trim($user->email))). "?s=128&d=mm" }}" alt="Image" class="profile-user-icon">
                    </figure>
                    <form id="userInfo" action="{{ route('profile.edit', $user->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        <input type="text" class="input is-rounded has-text-centered profile-username " :class="(!isEdit)? 'is-static' : ''" value="{{ $user->username }}" name="username" :readonly="!isEdit" v-cloak>

                        <input type="text" class="input is-rounded has-text-centered profile-email m-top-5" :class="(!isEdit)? 'is-static' : '' " value="{{ $user->email }}" name="email" :readonly="!isEdit" v-cloak>

                        {{--<div class="columns m-top-5" style="display: none;">--}}
                            {{--<div class="column is-6">--}}
                                {{--<input type="password" class="input" name="password">--}}
                            {{--</div>--}}
                            {{--<div class="column is-6">--}}
                                {{--<input type="password" class="input" name="password_confirmation">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="has-text-centered profile-gender {{ ($user->gender == 'male')? "is-male" : "is-female" }}">
                            @if($user->gender == 'male')
                                <i class="fa fa-mars" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-venus" aria-hidden="true"></i>
                            @endif
                        </div>
                    </form>
                    <hr>
                    <div class="level">
                        <div class=" level-item">
                            <div class=" has-text-centered">
                                <div class="heading">Role</div>
                                <strong>{{ $user->getRoleNames()[sizeof($user->getRoleNames()) - 1]  }}</strong>

                            </div>
                        </div>
                        <div class="level-item ">
                            <div class=" has-text-centered">
                                <div class="heading">last online</div>
                                <strong>
                                    @if(($user->last_login_at))
                                        {{ $user->last_login_at->diffForHumans() }}
                                    @else
                                        Never login
                                    @endif
                                </strong>
                            </div>
                        </div>
                        <div class=" level-item">
                            <div class=" has-text-centered">
                                <div class="heading">Register day</div>
                                <strong>{{ $user->created_at->toFormattedDateString() }}</strong>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
            {{--<div class="column is-6">--}}
                {{--<div class="">--}}
                    {{--<header class="card-header ">--}}
                        {{--<p class="card-header-title recent-act-header">Recent activities</p>--}}
                    {{--</header>--}}
                    {{--<div class="m">--}}
                        {{--<table class="table is-fullwidth is-hoverable">--}}
                            {{--<thead>--}}
                            {{--<tr>--}}
                                {{--<th>Topic</th>--}}
                                {{--<th>Post Owner</th>--}}
                                {{--<th>Date</th>--}}
                                {{--<th>View</th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                            {{--@for($i = 0;$i<5 ;$i++)--}}
                                {{--<tr>--}}
                                    {{--<td>Hello</td>--}}
                                    {{--<td>David</td>--}}
                                    {{--<td>Jan 3, 2018</td>--}}
                                    {{--<td><a href="#" class="button is-success">--}}
                                            {{--<i class="fa fa-pencil-square-o" aria-hidden="true"></i>--}}
                                        {{--</a></td>--}}
                                {{--</tr>--}}
                            {{--@endfor--}}
                            {{--</tbody>--}}
                        {{--</table>--}}
                        {{--1|2|3|4--}}
                    {{--</div>--}}
            {{--</div>--}}
        </div>

    </div>
@endsection

@section('js')
    @include('inc.messages.message')
    <script>
        new Vue({
            el:"#profile",
            data:{
                isEdit: false,
            },
            methods:{
                editUser: function(){
                    console.log('123');

                    document.getElementById("userInfo").submit();
                }
            }
        })
    </script>
@endsection