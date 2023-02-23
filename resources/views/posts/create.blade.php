@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Post') }}</div>
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
                        <h2>{{ __('Post Create') }}
                        </h2>
                        <div>
                            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data"
                                  class="form-control">
                                @csrf
                                <div class="mb-6">
                                    <label class="block">
                                        <span>Title</span>
                                        <input type="text" name="title"
                                               class="form-control block w-full @error('title') border-red-500 @enderror mt-1 rounded-md"
                                               placeholder="enter title here" value="{{old('title')}}"/>
                                    </label>
                                    @error('title')
                                    <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-6">
                                    <label class="block">
                                        <span>Picture</span>
                                        <input type="file" name="picture"
                                               class="form-control block w-full @error('picture') border-red-500 @enderror mt-1 rounded-md"
                                               placeholder="" value="{{old('picture')}}"/>
                                    </label>
                                    @error('picture')
                                    <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-6 ">
                                    <label class="block">
                                        <span>Select Category</span>
                                        <select name="category_id" class="form-control">
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                    @error('category_id')
                                    <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-6">
                                    <label class="block">
                                        <span>Description</span>
{{--                                        <textarea class="form-control" name="description" placeholder="enter description here" rows="3">{{old('description')}}</textarea>--}}
                                        <textarea class="ckeditor form-control" name="description"></textarea>
                                    </label>
                                    @error('description')
                                    <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-6">
                                    <label class="block">
                                        <span>Publish date</span>
                                        <input type="date" name="publish_date" class="form-control">
                                    </label>
                                    @error('publish_date')
                                    <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit"
                                        class="btn btn-primary">Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
