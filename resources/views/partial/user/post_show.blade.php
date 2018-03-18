@extends('layouts.app')

@section('title')
    {{ $post->topic }}
@endsection

@section('content')
    <div class="container" id="post">
        <div class="modal" :class="{'is-active': isReplyModalActive}" @click="isClose()" >
            <div class="modal-background" ></div>
            <div class="modal-card" @click.stop="">
                <form action="{{ route('reply.store') }}" method="post">
                    {{ csrf_field() }}
                    <header class="modal-card-head">
                        <p class="modal-card-title">Reply</p>
                        <button class="delete" aria-label="close" @click.prevent="isClose()"></button>
                    </header>
                    <section class="modal-card-body">
                        <div class="columns">
                            <div class="column is-12">
                                <input type="hidden" name="postID" class="input" value="{{ $post->id }}">
                                <b-field label="Content" label="Content" message="{{$errors->has('content')? $errors->first('content'): ''}}"
                                         type="{{$errors->has('content')? 'is-danger': ''}}" required>
                                    <b-input name="content" maxlength="1000" type="textarea" placeholder="Your views..."></b-input>
                                </b-field>
                            </div>
                        </div>
                    </section>
                    <footer class="modal-card-foot">
                        <button class="button is-info" type="submit">Reply</button>
                        <button class="button" @click.prevent="isClose()">Cancel</button>
                    </footer>
                </form>
            </div>
        </div>

        <div class="column is-three-fifths is-offset-one-fifth post-header-column " :class="{'is-scroll' : isScrollDown}">
            <div class="post-header ">
                <div class="level is-mobile">
                    {{ $post->topic }}
                </div>
            </div>
        </div>

        <div class=" m-top-20">
            <div class="column is-three-fifths is-offset-one-fifth">
                <article class="media">
                    <figure class="media-left m-top-30">
                        <div class="image is-64x64">
                            <img class="user-icon" src="{{"https://www.gravatar.com/avatar/" . md5(strtolower(trim($post->user->email))). "?s=64&d=mm" }}">
                        </div>

                    </figure>
                    <div class="media-content">
                        {{--topic--}}
                        <div class="post-topic">
                            <div class="level">
                                {{--post topic--}}
                                <strong class="level-left">{{ $post->topic }}</strong>
                                {{--comment number--}}
                                <span class="level-right m-right-10">#1</span>
                            </div>
                        </div>
                        {{--content--}}
                        <div class="post-content">
                            {{--create time and category name--}}
                            <div class="content-header">
                                <div class="level m-top-5">
                                    <div class="level-left">
                                        <div class="post-owner">
                                            {{--username--}}
                                            <span class=" {{ $post->user->gender == 'male'? 'is-male' : 'is-female' }}">
                                                <a href="#">{{ $post->user->username }}</a></span>
                                        </div>
                                        <span class="icon has-icon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                                        <b-tooltip type="is-light" position="is-bottom" label="{{ $post->created_at }}">
                                            <small class="has-text-grey-light">{{ $post->created_at->diffForHumans() }}</small>
                                        </b-tooltip>
                                        <category-tag category-name="{{ $post->category->name }}"></category-tag>
                                    </div>
                                    <div class="level-right">
                                        <span class=""></span>
                                    </div>
                                </div>
                            </div>
                            {{--post content--}}
                            <div class="content-body">
                                <p>{{ $post->content }}</p>
                            </div>
                            {{--like and dislike--}}
                            <div class="content-footer">
                                <div class="likeAndDislike">
                                    <span class="like" v-cloak>
                                        <a href="#" class="icon has-icon is-agree" @click.prevent="rating('like')"><i class="fa " :class="hasLike? 'fa-thumbs-up' : 'fa-thumbs-o-up'" aria-hidden="true"></i></a>
                                        <span class="like-number">@{{ likeValueCom }}</span>
                                    </span>
                                    <span class="dislike m-left-10" v-cloak>
                                        <a href="#" class="icon has-icon is-disagree" @click.prevent="rating('dislike')"><i class="fa" :class="hasDislike? 'fa-thumbs-down' : 'fa-thumbs-o-down'" aria-hidden="true"></i></a>
                                        <span class="dislike-number">@{{ dislikeValueCom }}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>

        <reply-list :post-i-d="{{ $post->id }}" v-model="selectedPage"></reply-list>

        <div class="toolbar">
            {{--<div class="left-toolbar">--}}
                {{--<ul>--}}
                    {{--<li><span class="has-icon icon is-large ">--}}
                            {{--<a href="#" class="has-text-link ">--}}
                                {{--<b-tooltip type="is-white" position="is-right" label="share through facebook">--}}
                                    {{--<i class="fa fa-lg fa-facebook-official share-fb" aria-hidden="true"></i>--}}
                                {{--</b-tooltip>--}}
                            {{--</a>--}}
                        {{--</span>--}}
                    {{--</li>--}}
                    {{--<li><span class="has-icon icon is-large ">--}}
                            {{--<a href="#" class="has-text-info ">--}}
                                {{--<b-tooltip type="is-white" position="is-right" label="share through twitter">--}}
                                    {{--<i class="fa fa-lg fa-twitter-square share-twitter" aria-hidden="true"></i>--}}
                                {{--</b-tooltip>--}}
                            {{--</a>--}}
                        {{--</span>--}}
                    {{--</li>--}}
                    {{--<li><span class="has-icon icon is-large ">--}}
                            {{--<a href="#" class="has-text-primary ">--}}
                                {{--<b-tooltip type="is-white" position="is-right" label="share through whatsapp">--}}
                                    {{--<i class="fa fa-lg fa-whatsapp share-wtsapp" aria-hidden="true"></i>--}}
                                {{--</b-tooltip>--}}
                            {{--</a>--}}
                        {{--</span>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</div>--}}
            <div class="right-toolbar">
                <ul>
                    <li><span class="has-icon icon is-large ">
                        <a href="{{ route('category.show',$post->category->id) }}" class="has-text-grey-light">
                            <b-tooltip type="is-white" position="is-left" label="Back to category page">
                               <i class="fa fa-lg fa-arrow-left category-page" aria-hidden="true"></i>
                            </b-tooltip>
                        </a>
                        </span>
                    </li>
                    <li>
                        <span class="has-icon icon is-large ">
                            <a href="#" class="has-text-dark" @click.prevent="isOpen">
                                <b-tooltip type="is-white" position="is-left" label="reply">
                                   <i class="fa fa-lg fa-reply reply-post" aria-hidden="true"></i>
                                </b-tooltip>
                            </a>
                        </span>
                    </li>
                    <li><span class="has-icon icon is-large ">
                            <a href="#" class="has-text-warning" @click.prevent="bookmark">
                                <b-tooltip type="is-white" position="is-left" label="bookmark">
                                   <i class="fa fa-lg fa-bookmark-o bookmark-post" aria-hidden="true"></i>
                                </b-tooltip>
                            </a>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="column is-three-fifths is-offset-one-fifth tools-mobile-bar" :class="{ 'is-bottom-scroll': !isScrollDown }">
            <ul class="columns tool-list">
                <li><span class="has-icon icon is-large ">
                            <a href="#" class="has-text-link ">
                                <b-tooltip type="is-white" position="is-right" label="share through facebook">
                                    <i class="fa fa-lg fa-facebook-official share-fb" aria-hidden="true"></i>
                                </b-tooltip>
                            </a>
                        </span>
                </li>
                <li><span class="has-icon icon is-large ">
                            <a href="#" class="has-text-info ">
                                <b-tooltip type="is-white" position="is-right" label="share through twitter">
                                    <i class="fa fa-lg fa-twitter-square share-twitter" aria-hidden="true"></i>
                                </b-tooltip>
                            </a>
                        </span>
                </li>
                <li><span class="has-icon icon is-large ">
                            <a href="#" class="has-text-primary ">
                                <b-tooltip type="is-white" position="is-right" label="share through whatsapp">
                                    <i class="fa fa-lg fa-whatsapp share-wtsapp" aria-hidden="true"></i>
                                </b-tooltip>
                            </a>
                        </span>
                </li>
                <li><span class="has-icon icon is-large ">
                        <a href="{{ route('category.show',$post->category->id) }}" class="has-text-grey-light">
                            <b-tooltip type="is-white" position="is-left" label="Back to category page">
                               <i class="fa fa-lg fa-arrow-left category-page" aria-hidden="true"></i>
                            </b-tooltip>
                        </a>
                        </span>
                </li>
                <li>
                        <span class="has-icon icon is-large ">
                            <a href="#" class="has-text-dark" @click.prevent="isOpen">
                                <b-tooltip type="is-white" position="is-left" label="reply">
                                   <i class="fa fa-lg fa-reply reply-post" aria-hidden="true"></i>
                                </b-tooltip>
                            </a>
                        </span>
                </li>
                <li><span class="has-icon icon is-large ">
                            <a href="#" class="has-text-warning">
                                <b-tooltip type="is-white" position="is-left" label="bookmark">
                                   <i class="fa fa-lg fa-bookmark-o bookmark-post" aria-hidden="true"></i>
                                </b-tooltip>
                            </a>
                        </span>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('js')
    <script>
        new Vue({
            el:'#post',
            data:{
                isScrollDown: false,
                isReplyModalActive: false,
                selectPage: 1,
                likeValue: {!!  $post->rating()->where('rating', '=', 1)->count()  !!},
                dislikeValue: {!!  $post->rating()->where('rating', '=', 0)->count()  !!},
            },
            methods: {
                scrollHandle: function () {
                    let vm = this;
                    window.addEventListener("scroll", function () {
                        var currentScrollPosition = $(this).scrollTop();
                        if (currentScrollPosition >= this.scrollPosition) {
                            vm.isScrollDown = true;
                        } else {
                            vm.isScrollDown = false;
                        }
                        this.scrollPosition = currentScrollPosition;
                    })
                },
                rating: function (input) {
                    var rate;
                    if (input === 'like'){
                        rate = 1;
                    }else{
                        rate = 0;
                    }
                    const url = "http://localhost:8000/api/rating/";
                    if (this.isLogin){
                        let vm = this;
                        axios.get(url , {
                            params : {
                                post_id: {!! $post->id !!}  ,
                                user_id: {!! (Auth::check())? Auth::user()->id : -1 !!},
                                rating: rate,
                            }
                        }).then(function(response){
                            vm.$snackbar.open({
                               message: response.data.message,
                               type: "is-info",
                               position: "is-top",
                            });
                            if (_.includes(response.data.message,"success")){
                                console.log(response.data.rating.rating);
                                if (response.data.rating.rating){
                                    vm.likeValue++;
                                    this.isLiked = true;
                                }else{
                                    vm.dislikeValue++;
                                    this.isDisliked = true;
                                }
                            }
                        }).catch(function(error){
                            console.log(error);
                        })
                    }else{
                        this.$snackbar.open({
                            message: "Your should login first",
                            type: "is-warning",
                            position: 'is-top',
                        });
                    }

                },
                bookmark: function(){
                    const url = "http://localhost:8000/api/bookmark/";
                    if (this.isLogin){
                        let vm = this;
                        axios.post(url , {
                            post_id: {!! $post->id !!}  ,
                            user_id: {!! (Auth::check())? Auth::user()->id : -1 !!},
                        }).then(function(response){
                            vm.$snackbar.open({
                                message: response.data.message,
                                type: _.includes(response.data.message,"success")? "is-info" : "is-danger",
                                position: "is-top",
                            });
                            console.log(response.data.message);
                        }).catch(function(error){
                            console.log(error);
                        })
                    }
                },
                isOpen: function(){
                    if (this.isLogin){
                        this.isReplyModalActive = true;
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
                            this.isReplyModalActive = false;
                        }
                    })
                },
                selectedPage: function(value){
                    console.log(value);
                }
            },
            mounted: function(){
                this.scrollHandle();
            },
            computed: {
                isLogin: function(){
                    return {!! (Auth::check() == 1)? 'true':'false' !!}
                },
                likeValueCom: function(){
                    return this.likeValue;
                },
                dislikeValueCom: function(){
                    return this.dislikeValue;
                },
                hasLike: function(){
                    return {!! (Auth::check())? (Auth::user()->rating()->where('post_id' , $post->id)->exists())? (Auth::user()->rating()->where('post_id' , $post->id)->first()->rating) ? 'true' : 'false' : 'false' : 'false' !!};
                },
                hasDislike: function(){
                    return {!! (Auth::check())? (Auth::user()->rating()->where('post_id' , $post->id)->exists())? (Auth::user()->rating()->where('post_id' , $post->id)->first()->rating) ? 'false' : 'true' : 'false' : 'false' !!};
                }
            }
        })
    </script>
@endsection