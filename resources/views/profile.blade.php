@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3 class="text-center">{{ __($profile->name) }}</h3></div>
                    <div>
                        <a class="btn btn-primary" href="{{ route('posts.create') }}">{{ __('Add Post') }}</a>
                    </div>

                    <div class="card-body">
                        <table>
                            <thead>
                            <tr>
                                <th scope="col">
                                    #
                                </th>
                                <th scope="col">
                                    Name
                                </th>
                                <th scope="col">
                                    Category
                                </th>
                                <th scope="col">
                                    Description
                                </th>
                                <th scope="col">
                                    Edit
                                </th>
                                <th scope="col">
                                    Show
                                </th>
                                <th scope="col">
                                    Delete
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <th scope="row">
                                        {{$post->id}}
                                    </th>
                                    <td>
                                        {{$post->title}}
                                    </td>
                                    <td>
                                        {{$post->category->name}}
                                    </td>
                                    <td>
                                        {{ strip_tags( $post->description ) }}
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('posts.edit',$post->id) }}">Edit</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('posts.show',$post->id) }}">Show</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('posts.destroy',$post->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('{{ trans('are You Sure ? ') }}');"
                                        >
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token"
                                                   value="{{ csrf_token() }}">
                                            <input type="submit"
                                                   class="btn btn-danger"
                                                   value="Delete">
                                        </form>
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
    </div>
@endsection
