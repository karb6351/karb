@extends('layouts.app')
@section('content')
<div class="container" id="category">
    <div class="modal" :class="{'is-active': isCreatePostModalActive}" @click="isClose()">
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
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                            <li ><a class="menu-list-item">
                                <span class="icon is-medium create-post-icon">
                                    <i class="fa fa-circle-o-notch" aria-hidden="true"></i>
                                </span>Record</a></li>
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
                                <li><a href="#" class="menu-list-item">
                                    <span></span>First category</a></li>
                                <li><a href="#" class="menu-list-item">
                                    <span></span>Second category</a></li>
                                <li><a href="#" class="menu-list-item">
                                    <span></span>Third category</a></li>
                                <li><a href="#" class="menu-list-item">
                                    <span></span>Fourth category</a></li>
                                <li><a href="#" class="menu-list-item">
                                    <span></span>Define category</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="column is-8 post-lists p-left-30 p-right-30">
            @for ($i=0; $i < 9; $i++)
                <article class="media single-post-list">
                    <figure class="media-left">
                        <img class="user-icon" src="https://bulma.io/images/placeholders/128x128.png">
                    </figure>
                    <div class="media-content">
                        <div class="content">
                            <div class="content-top">
                                <small class="post-owner is-male">John Smith</small>
                                <small class="post-created-at">31m</small>
                                <span class="icon is-small like-icon-positive m-left-5">
                                    @if (true)
                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                                    @endif

                                </span>
                                <small class="like-number-icon">3</small>
                            </div>
                            <a href="#"><strong><h4 class="title post-title">Here is the post topic</h4></strong></a>
                        </div>
                    </div>
                    <div class="media-right p-right-5">
                        <div class="topic-list-right-top">
                            <span class="tag is-dark category-tag">First category</span>
                        </div>
                        <div class="topic-list-right-bottom select is-rounded is-small m-top-5">
                            <select name="">
                                <option value="">Page 1</option>
                            </select>
                        </div>
                    </div>
                </article>
            @endfor
            @foreach ($posts as $post)
                <article class="media single-post-list">
                    <figure class="media-left">
                        <img class="user-icon" src="https://bulma.io/images/placeholders/128x128.png">
                    </figure>
                    <div class="media-content">
                        <div class="content">
                            <div class="content-top">
                                {{--user profile--}}
                                <small><a href="#" class="post-owner {{ $post->user->gender == 'male'? 'is-male' : 'is-female' }}">
                                        {{ $post->user->username }}</a></small>
                                <small class="post-created-at">{{ $post->created_at->diffForHumans() }}</small>
                                <span class="icon is-small like-icon-positive m-left-5">
                                    {{--like and dislike--}}
                                    @if (true)
                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                                    @endif

                                </span>
                                {{--like number--}}
                                <small class="like-number-icon">3</small>
                            </div>
                            <a href="{{ route('post.show',$post->id) }}">
                                <strong><h4 class="title post-title">{{ $post->topic }}</h4></strong></a>
                        </div>
                    </div>
                    <div class="media-right p-right-5">
                        <div class="topic-list-right-top">
                            <span class="tag is-dark category-tag">{{ $post->category->name }}</span>
                        </div>
                        <div class="topic-list-right-bottom select is-rounded is-small m-top-5">
                            {{--reply--}}
                            <select name="">
                                <option value="">Page 1</option>
                            </select>
                        </div>
                    </div>
                </article>
            @endforeach

            <div class="page">
                {{ $posts->links() }}
            </div>
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

                }
            },
            computed: {
                isLogin: function(){
                    return {!! (Auth::check() == 1)? 'true':'false' !!}
                }
            }
        })
    </script>
@endsection
