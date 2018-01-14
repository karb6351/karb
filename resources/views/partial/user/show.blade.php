@extends('layouts.app')

@section('title')
    {{ $post->topic }}
@endsection

@section('content')
    <div class="container" id="post">
        <div class="column is-three-fifths is-offset-one-fifth post-header-column" :class="{'is-scroll' : isScrollDown}">
            <div class="post-header">
                <div class="level is-mobile">
                    <div class="level-left">
                        <div class="level-item">
                            {{ $post->topic }}
                        </div>
                    </div>
                    <div class="level-right">
                        <span class="level-item ">
                            <span class="select is-rounded">
                                <select name="" id="" >
                                    <option value="">1</option>
                                </select>
                            </span>
                        </span>
                        <span class="level-item">
                            <span class="buttons">
                                <button class="button is-outlined is-info m-left-5">
                                    previous
                                </button>
                                <button class="button is-outlined is-info m-right-5">
                                    next
                                </button>
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class=" m-top-20">
            <div class="column is-three-fifths is-offset-one-fifth">
                <article class="media">
                    <figure class="media-left m-top-15">
                        <div class="image is-64x64">
                            <img class="user-icon" src="https://bulma.io/images/placeholders/128x128.png">
                        </div>
                        <div class="post-owner m-top-5 m-left-5">
                            {{--username--}}
                            <span class=" {{ $post->user->gender == 'male'? 'is-male' : 'is-female' }}">
                                <a href="#">{{ $post->user->username }}</a></span>
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
                                        <span class="icon has-icon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                                        <b-tooltip type="is-light" position="is-bottom" label="{{ $post->created_at }}">
                                            <small class="has-text-grey-light">{{ $post->created_at->diffForHumans() }}</small>
                                        </b-tooltip>
                                        <span class="tag is-dark m-left-5">{{ $post->category->name }}</span>
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
                                    <span class="like">
                                        <a href="#" class="icon has-icon is-agree"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
                                        <span class="like-number">3</span>
                                    </span>
                                    <span class="dislike m-left-10">
                                        <a href="#" class="icon has-icon is-disagree"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a>
                                        <span class="dislike-number ">3</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>

        @for($i=0;$i<25;$i++)
            <div class="column column is-three-fifths is-offset-one-fifth m-top-15">
                <article class="media">
                    <figure class="media-left m-top-10">
                        <p class="image is-64x64">
                            <img class="user-icon" src="https://bulma.io/images/placeholders/128x128.png">
                        </p>
                        {{--<span class=" {{ $post->reply->user->gender == 'male'? 'is-male' : 'is-female' }}">--}}
                        {{--<a href="#">{{ $post->reply->user->username }}</a></span>--}}
                        <span class="is-male m-top-5 m-left-5">
                                <a href="#"><strong>Admin</strong></a></span>
                    </figure>
                    <div class="media-content">
                        <div class="content">
                            <div class="level reply-body">
                                <span class="level-left">
                                    <span class="icon has-icon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                                     <b-tooltip type="is-light" position="is-bottom" label="time">
                                            <small class="has-text-grey-light">31m ago</small>
                                     </b-tooltip>
                                     <b-tooltip type="is-light" position="is-bottom" label="Reply this comment">
                                         <a href="#" class="icon has-icon reply-icon"><i class="fa fa-reply" aria-hidden="true"></i></a>
                                     </b-tooltip>
                                </span>
                                <span class="level-right m-right-10">#2</span>
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna eros, eu pellentesque tortor vestibulum ut. Maecenas non massa sem. Etiam finibus odio quis feugiat facilisis.
                            </p>
                        </div>
                    </div>
                </article>
            </div>
        @endfor
        <div class="toolbar">
            <div class="left-toolbar">
                <ul>
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
                </ul>
            </div>
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
                            <a href="#" class="has-text-dark">
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
                            <a href="#" class="has-text-dark">
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
            },
            methods: {
                scrollHandle: function () {
                    let vm = this;
                    window.addEventListener("scroll", function () {
                        var currentScrollPosition = $(this).scrollTop();
                        if (currentScrollPosition >= this.scrollPosition) {
                            vm.isScrollDown = true;
                            console.log("Scrolling down");
                        } else {
                            vm.isScrollDown = false;
                            console.log("Scrolling up");
                        }
                        this.scrollPosition = currentScrollPosition;
                    })
                },
            },
            mounted: function(){
                this.scrollHandle();
            },
        })
    </script>
@endsection