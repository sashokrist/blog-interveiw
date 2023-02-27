@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3 class="text-center">{{ __($post->title) }}</h3></div>
                    <div>
                        <a href="{{ route('home') }}" class="btn btn-primary">Back to blog</a>
                    </div>

                    <div class="card-body">
                        <h4>Title: {{ $post->title }}</h4>
                        <h4>Description: {{ strip_tags( $post->description ) }}</h4>
                        <h4>Published: {{ $post->publish_date }}</h4>
                        <h4>Category: {{ $category }}</h4>
                        <img src="{{ asset('images/'.$post->picture) }}" width="100" height="100" alt="no image">
                        <div class="row">
                            <div>
                                <form action="{{ route('like', $post->id) }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-circle btn-sm"
                                               value="Like {{ $countLike }}"/>
                                    </div>
                                </form>
                            </div>
                            <div>
                                <form action="{{ route('dislike', $post->id) }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-circle btn-sm"
                                               value="Disike {{ $countDislike }}"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <h4>Display Comments</h4>
                        @include('posts.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])
                        <hr/>
                        <h4>Add comment</h4>
                        <form method="post" action="{{ route('comments.store'   ) }}">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control" name="body"></textarea>
                                <input type="hidden" name="post_id" value="{{ $post->id }}"/>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" value="Add Comment"/>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
