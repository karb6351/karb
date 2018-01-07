@extends('layouts.app')
@section('content')
<div class="container">
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
                            <li ><a class="menu-list-item">
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
            @for ($i=0; $i < 10; $i++)
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
            <div class="page">
                1|2|3|4
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    @include('inc.messages.message')
@endsection
