@extends('layouts.app')

@section('title')
    Search
@endsection

@section('content')
    <div class="column is-8 is-offset-2">
        <div class="column">
            <form action="{{ route('search.search') }}" method="post">
                {{ csrf_field() }}
                <div class="field has-addons">

                    <div class="control is-expanded">
                        <input type="text" class="input" name="value" placeholder="Please enter keywords (Post owner's name/Post's topic)">
                    </div>
                    <div class="control">
                        <button class="button is-info is-outlined" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="m-top-10">
            @if(!empty($posts))
                @foreach($posts as $post)
                    <div class="post-lists">
                        <article class="media single-post-list">
                            <figure class="media-left">
                                <img class="user-icon" src="https://bulma.io/images/placeholders/128x128.png">
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

                        </article>
                    </div>
                @endforeach
                {{ $posts->links() }}
            @endif
        </div>
    </div>
@endsection

@section('js')
    @include('inc.messages.message')
@endsection