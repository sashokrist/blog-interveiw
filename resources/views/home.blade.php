@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div>
                <h4>Filter Categories</h4>
                <form action="{{ route('search') }}" method="GET">
                    <select class="form-select"  name="search">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-info" type="submit">Submit</button>
                </form>
            </div>
            <div>
                <h4>Search Post</h4>
                <form action="{{ route('search-post') }}" method="GET">
                        <input class="form-control" type="text" name="searchPost" placeholder="enter some text">
                    <button class="btn btn-info" type="submit">Search</button>
                </form>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3 class="text-center">{{ __('Blog') }}</h3></div>
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('posts.create') }}">{{ __('Add Post') }}</a>
                        <table>
                            <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Created
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td class="px-6 py-4">
                                        {{$post->title}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ strip_tags( $post->description ) }}
                                        <a href="{{ route('posts.show',$post->id) }}">...read more</a>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$post->created_at->diffForHumans()}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
