@extends('layouts.app')

@section('title')
   bookmark
@endsection

@section('content')
    <div id="bookmark" class="column is-8 is-offset-2">
        <div class="ordering m-top-20 m-bottom-40 m-left-20 m-right-20">
            <div class="columns tabs is-toggle is-fullwidth">
                <ul>
                    <li class=" is-centered {{ Request::has('order')? "":"is-active" }}">
                        <a href={{ route('bookmark.get')}}> Sort by post's create time</a>
                    </li>
                    <li class="  is-centered {{ Request::has('order')? "is-active":"" }}">
                        <a href={{ url('bookmark/?order=bookmark') }}> Sort by bookmark time</a>
                    </li>
                </ul>
            </div>
        </div>
        @if(!empty($bookmarkPosts))
            @foreach($bookmarkPosts as $bookmarkPost)
                <div class="post-lists">
                    <article class="media single-post-list">
                        <figure class="media-left">
                            <img class="user-icon" src="{{"https://www.gravatar.com/avatar/" . md5(strtolower(trim($bookmarkPost->post->user->email))). "?s=64&d=mm" }}">
                        </figure>
                        <div class="media-content">
                            <div class="content">
                                <div class="content-top">
                                    <a href="#">
                                        <small class="post-owner {{  ($bookmarkPost->post->user->gender == 'male') ? 'is-male' : 'is-female' }}">{{ $bookmarkPost->post->user->username }}</small>
                                    </a>
                                    <small class="post-created-at">{{ $bookmarkPost->post->created_at->diffForHumans() }}</small>
                                    <span class="icon is-small m-left-5 {{ ($bookmarkPost->post->rating()->where('rating', '1')->count() - $bookmarkPost->post->rating()->where('rating', '0')->count() >= 0 )? "like-icon-positive" : "like-icon-negative" }}"  >
                                    <i class="is-dark fa {{ ($bookmarkPost->post->rating()->where('rating', '1')->count() - $bookmarkPost->post->rating()->where('rating', '0')->count() >= 0 )?  "fa-thumbs-up" : "fa-thumbs-down" }}" aria-hidden="true"></i>
                                    </span>
                                    <small class="like-number-icon ">{{ $bookmarkPost->post->rating()->where('rating', '1')->count() - $bookmarkPost->post->rating()->where('rating', '0')->count() }}</small>
                                </div>
                                <a href={{ route('post.show', $bookmarkPost->post->id) }}><strong><h4 class="title post-title">{{ $bookmarkPost->post->topic }}</h4></strong></a>
                            </div>
                        </div>
                        <div class="media-right p-right-5">
                            <div class="topic-list-right-top">
                                {{--<category-tag :category-name="{{ $bookmarkPost->post->category->name }}"></category-tag>--}}
                            </div>
                            <div class="topic-list-right-bottom m-top-5">
                                <a href="#" class="button is-danger" @click.prevent="deleteBookmarkPost">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </div>

                            <form id="deleteBookmark-form" action="{{ route('bookmark.delete') }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <input type="hidden" name="post_id" value="{{ $bookmarkPost->post->id }}">
                            </form>

                        </div>
                    </article>
                </div>
            @endforeach
            {{ $bookmarkPosts->links() }}
        @else
            You have not bookmark post
        @endif

    </div>
@endsection

@section('js')
    @include('inc.messages.message')
    <script>
        new Vue({
            el: "#bookmark",
            methods: {
                deleteBookmarkPost: function(){
                    document.getElementById('deleteBookmark-form').submit();
                }
            }
        })
    </script>

@endsection