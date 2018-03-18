@extends('layouts.app')

@section('title')
    {{ $category->name }}
@endsection

@section('content')
<div class="container" id="category">

    <div class="modal" :class="{'is-active': isCreatePostModalActive}" @click="isClose()" >
        <div class="modal-background" ></div>
        <div class="modal-card" @click.stop="">
            <form action="{{ route('post.store') }}" method="post">
                {{ csrf_field() }}
                <header class="modal-card-head">
                    <p class="modal-card-title">Create Post</p>
                    <button class="delete" aria-label="close" @click.prevent="isClose()"></button>
                </header>
                <section class="modal-card-body">
                    <div class="columns">
                        <div class="column is-8">
                            <b-field label="Topic" message="{{$errors->has('topic')? $errors->first('topic'): ''}}"
                                     type="{{$errors->has('topic')? 'is-danger': ''}}" required>
                                <input name="topic" type="text" class="input" placeholder="Topic">
                            </b-field>
                        </div>
                        <div class="column is-4">
                            <b-field label="Category" message="{{$errors->has('categoryID')? $errors->first('categoryID'): ''}}"
                                     type="{{$errors->has('categoryID')? 'is-danger': ''}}" required>
                                <b-select name="categoryID" placeholder="Select a category">
                                    @foreach($categories as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </b-select>
                            </b-field>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column is-12">
                            <b-field label="Content" label="Content" message="{{$errors->has('content')? $errors->first('content'): ''}}"
                                     type="{{$errors->has('content')? 'is-danger': ''}}" required>
                                <b-input name="content" maxlength="1000" type="textarea" placeholder="Your views..."></b-input>
                            </b-field>
                        </div>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-info" type="submit">Create</button>
                    <button class="button" @click.prevent="isClose()">Cancel</button>
                </footer>
            </form>
        </div>
    </div>
    <div class="columns">
        <div class="column is-offset-1 is-2">
            <div class="left-panel">
                <div class="user m-bottom-15">
                    <div class="user-header">
                        <span class="icon is-small is-pulled-left">
                            <i class="fa fa-wrench" aria-hidden="true"></i>
                        </span>
                        Tools
                    </div>
                    <aside class="menu">
                        <ul class="menu-list">
                            <li ><a class="menu-list-item" @click.prevent="isOpen">
                                <span class="icon is-medium create-post-icon">
                                    <i class="fa fa-book" aria-hidden="true"></i>
                                </span>Create Post</a></li>
                            {{--<li ><a class="menu-list-item">--}}
                                {{--<span class="icon is-medium create-post-icon">--}}
                                    {{--<i class="fa fa-circle-o-notch" aria-hidden="true"></i>--}}
                                {{--</span>Record</a></li>--}}
                            <li ><a class="menu-list-item" href="{{ route('search.getPage') }}">
                                <span class="icon is-medium create-post-icon">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </span>Search</a></li>
                          </ul>
                    </aside>
                </div>

                <div class="category">
                    <div class="category-header">
                        <span class="icon is-small is-pulled-left">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </span>
                        Catogories
                    </div>
                    <div class="category-content">
                        <div class="menu">
                            <ul class="menu-list">
                                @foreach($categories as $c)
                                <li><a href="{{ route('category.show',$c->id) }}" class="menu-list-item">
                                    <span></span>{{ $c->name }}</a></li>
                                @endforeach
                                {{--<li><a href="#" class="menu-list-item">--}}
                                    {{--<span></span>Define category</a></li>--}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="column is-8 post-lists p-left-30 p-right-30">
            <post-list :positive="true" :category-i-d = "{{ $category->id }}"></post-list>
        </div>
    </div>
</div>

@endsection

@section('js')
    @include('inc.messages.message')
    <script>
        let modal = new Vue({
            el:"#category",
            data:{
                isCreatePostModalActive: false,
            },
            methods:{
                isOpen: function(){
                  if (this.isLogin){
                      this.isCreatePostModalActive = true;
                  }else{
                      this.$snackbar.open({
                          message: "You should login first",
                          type: "is-warning",
                          position: 'is-top',
                      })
                  }
                },
                isClose: function(){
                    this.$dialog.confirm({
                        message: 'Are you sure to exit, your work will not be saved',
                        type: 'is-info',
                        onConfirm: () => {
                            this.isCreatePostModalActive = false;
                        }
                    })
                },
            },
            computed: {
                isLogin: function(){
                    return {!! (Auth::check() == 1)? 'true':'false' !!}
                }
            },
        })
    </script>
@endsection
