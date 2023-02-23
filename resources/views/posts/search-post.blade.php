@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div>
                <a class="btn btn-primary" href="{{ route('home') }}">Back to blog</a>
            </div>
            <div class="col-md-8">
                <div class="card">
                    @if($posts->count() > 0)
                        <div class="card-header">{{ __('Search result') }}</div>
                        <div class="card-body">
                            <table>
                                <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Description
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Category
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($posts as $post)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            {{$post->id}}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{$post->title}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ strip_tags( $post->description ) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$post->category->name}}
                                        </td>
                                        <td class="px-6 py-4">
                                            <a class="btn btn-secondary"
                                               href="{{ route('posts.edit',$post->id) }}">Edit</a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a class="btn btn-secondary"
                                               href="{{ route('posts.show',$post->id) }}">Show</a>
                                        </td>
                                        <td class="px-6 py-4">
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
                @else
                    <h3 class="text-center">no result</h3>
                @endif
            </div>
        </div>
    </div>
@endsection
