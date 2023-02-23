@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        <h2>{{ __('Category Edit') }}</h2>
                        <div class="py-12">
                            <form method="POST" action="{{ route('posts.update',$post->id) }}"
                                  enctype="multipart/form-data" class="form-control">
                                @csrf
                                @method('put')
                                <div class="mb-6">
                                    <label class="block">
                                        <span>Title</span>
                                        <input type="text" name="title"class="form-control" value="{{old('title',$post->title)}}"/>
                                    </label>
                                </div>
                                <div class="mb-6">
                                    <label class="block">
                                        <span>Picture</span>
{{--                                        <input type="file" name="picture" class="form-control" value="{{old('picture'), $post->picture}}"/>--}}
                                        <input type="file" name="picture" class="form-control" placeholder="picture">
                                        <img src="{{ asset('images/'.$post->picture) }}"  width="100" height="100" alt="no image">
                                    </label>
                                </div>
                                <div class="mb-6">
                                    <label class="block">
                                        <span>Select Category</span>
                                        <select name="category_id" class="form-control">
                                            @foreach ($categories as $category)
                                                <option @selected($category->id === $post->category_id)
                                                        value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                </div>
                                <div class="mb-6">
                                    <label class="block">
                                        <span>Description</span>
                                        <textarea class="ckeditor form-control" name="description">{{ $post->description }}</textarea>
                                    </label>
                                </div>
                                <div class="mb-6">
                                    <label class="block">
                                        <span>Publish date</span>
                                        <input type="date" name="publish_date" class="form-control"
                                               value="{{ $post->publish_date }}">
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
