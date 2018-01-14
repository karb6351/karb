@extends('layouts.manage')

@section('content')
    <div class="post-manage-tile">
        Post Management
    </div>
    <div class="columns">
        <div class="column is-4">
            <nav class="level">
                <div class="level-item has-text-centered ">
                    <div>
                        <p class="heading">Total Post count</p>
                        <p class="title">{{ $totalCount }}</p>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <div>
                        <p class="heading">Today Post create</p>
                        <p class="title">{{ $postDaily }}</p>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div class="column is-12">
        <table class="table is-fullwidth is-hoverable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Topic</th>
                    <th>Post owner</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->topic }}</td>
                    <td><a href="{{ route('user.show',$post->user->id) }}">{{ $post->user->username }}</a></td>
                    <td>{{ $post->created_at->toFormattedDateString() }}</td>
                    <td>
                        <a href="{{ route('post.show',$post->id) }}" class="button is-grey">
                            <i class="fa fa-list-ul" aria-hidden="true"></i>
                        </a>
                        <a href="{{ route('admin.post.destroy',$post->id) }}" class="button is-danger">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $posts->links() }}
    </div>


@endsection