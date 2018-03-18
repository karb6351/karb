@extends('layouts.app')

@section('title')
    Comment list
@endsection

@section('content')
    <div class="column is-8 is-offset-2">
        @if(!empty($posts))

            @foreach($posts as $post)
                <div class="post-lists">
                    <article class="media single-post-list">
                        <figure class="media-left">
                            <img class="user-icon" src="{{"https://www.gravatar.com/avatar/" . md5(strtolower(trim($post->user->email))). "?s=64&d=mm" }}">
                        </figure>
                        <div class="media-content">
                            <div class="content">
                                <div class="content-top">
                                    <a href="#">
                                        <small class="post-owner {{  ($post->user->gender == 'male') ? 'is-male' : 'is-female' }}">{{ $post->user->username }}</small>
                                    </a>
                                    <small class="post-created-at">{{ $post->created_at->diffForHumans() }}</small>
                                    <span class="icon is-small m-left-5 {{ ($post->rating()->where('rating', '1')->count() - $post->rating()->where('rating', '0')->count() >= 0 )? "like-icon-positive" : "like-icon-negative" }}"  >
                                    <i class="is-dark fa {{ ($post->rating()->where('rating', '1')->count() - $post->rating()->where('rating', '0')->count() >= 0 )?  "fa-thumbs-up" : "fa-thumbs-down" }}" aria-hidden="true"></i>
                                    </span>
                                    <small class="like-number-icon ">{{ $post->rating()->where('rating', '1')->count() - $post->rating()->where('rating', '0')->count() }}</small>
                                </div>
                                <a href={{ route('post.show', $post->id) }}><strong><h4 class="title post-title">{{ $post->topic }}</h4></strong></a>
                            </div>
                        </div>
                        <div class="media-right p-right-5">
                            <div class="topic-list-right-top">
                                {{--<category-tag :category-name="{{ $post->category->name }}"></category-tag>--}}
                            </div>
                            <div class="topic-list-right-bottom m-top-5">
                                <a href="#" class="button is-danger" @click.prevent="deleteBookmarkPost">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </div>

                            {{--<form id="deleteBookmark-form" action="{{ route('bookmark.delete') }}" method="post">--}}
                            {{--{{ csrf_field() }}--}}
                            {{--{{ method_field('delete') }}--}}
                            {{--<input type="hidden" name="post_id" value="{{ $post->id }}">--}}
                            {{--</form>--}}

                        </div>
                    </article>
                </div>
            @endforeach
            {{ $posts->links() }}
        @endif
    </div>
@endsection