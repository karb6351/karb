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
        <div class="column is-2 is-offset-8 is-pulled-right">
            <a href="{{ route('user.edit',$user->id) }}" class="button is-link" {{ (Auth::user()->can('update',$user))? '': 'disabled' }}>
            <i class="fa fa-pencil-square-o m-right-5" ></i>Edit user</a>
        </div>
    </div>
    <div class="create-user">

        <div id="user-info">
            <div class="columns">
                <div class="column is-6">
                    <div class="create-user-header">User information</div>
                    <div class="column is-centered">
                       <span >Username: </span> <strong>{{ $user->username }}</strong>
                    </div>
                    <div class="column is-centered">
                        <span>Email: </span> <strong>{{ $user->email }} </strong>
                    </div>
                    <div class="column is-centered">
                        <span>Role: </span> <strong>{{ $user->getRoleNames()[sizeof($user->getRoleNames()) - 1] }} </strong>
                    </div>
                    <div class="column is-centered">
                        <span>Gender: </span> <strong>{{ $user->gender }}</strong>
                    </div>
                    <div class="column is-centered">
                        <span>Status: </span>
                        <strong>
                            @if($user->userActive->isActive)
                                @if(!$user->userActive->isBan)
                                    <span class="has-text-success">Normal</span>
                                @else
                                    <span class="has-text-danger">Ban</span>
                                @endif
                            @else
                                <span class="has-text-grey-light">Inactive</span>
                            @endif
                        </strong>
                    </div>
                    <div class="column is-centered">
                        <span>Register date: </span> <strong> {{ $user->created_at->toFormattedDateString() }} </strong>
                    </div>
                    <div class="column is-centered">
                        <span>Last online: </span>
                        @if($user->isOnline())
                           <strong class="has-text-success">online</strong>
                        @else
                            <strong class="has-text-danger">
                            @if(($user->last_login_at))
                                {{ $user->last_login_at->diffForHumans() }}
                            @else
                                Never login
                            @endif
                            </strong>
                        @endif

                    </div>
                </div>
                <div class="column is-6">
                        <div class="card m-top-20">
                            <header class="card-header ">
                                <p class="card-header-title recent-act-header">Recent activities</p>
                            </header>
                            <div class="m">
                                <table class="table is-fullwidth is-hoverable">
                                    <thead>
                                        <tr>
                                            <th>Topic</th>
                                            <th>Post Owner</th>
                                            <th>Date</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @for($i = 0;$i<5 ;$i++)
                                        <tr>
                                            <td>Hello</td>
                                            <td>David</td>
                                            <td>Jan 3, 2018</td>
                                            <td><a href="#" class="button is-success">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </a></td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                                1|2|3|4
                            </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>
@endsection

@section('js')
    <script>
        var form = new Vue({
            el: '#user-info',
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
