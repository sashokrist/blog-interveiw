<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostEditRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     *
     * @return Application|Factory|View
     */

    public function index()
    {
        $posts = Post::with('category')->latest()->paginate(10);

        return view('posts.index', compact('posts'));
    }

    /**
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $categories = Category::all();

        return view('posts.create', compact('categories'));
    }

    /**
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostCreateRequest $request)
    {
        $post = new Post;
        $input = $post->uploadPicture($request);
        $post->fill($input)->save();

        session()->flash('status', 'Post was created');

        return redirect()->route('home')->with('status', 'Post Created Successfully');
    }


    /**
     * Display the specified resource.
     * @param \App\Models\Post $post
     * @return Application|Factory|View
     */
    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'category' => $post->category->name,
        ]);
    }

    /**
     *
     * @param \App\Models\Post $post
     * @return Application|Factory|View
     */
    public function edit(Post $post)
    {
        $categories = Category::all();

        return view('posts.edit', compact('categories', 'post'));
    }

    /**
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostEditRequest $request, Post $post)
    {
        $input = $post->uploadPicture($request);
        $post->fill($input)->save();
        session()->flash('status', 'Post was updated Successfully');

        return redirect()->route('posts.index');
    }

    /**
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('status', 'Post Delete Successfully');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function search(Request $request)
    {
        $search = $request->input('search');

        $posts = Post::where('category_id', $search)->paginate(5);
        $categories = Category::all();

        return view('posts.search', compact('posts', 'categories'));
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function searchPost(Request $request)
    {
        $search = $request->input('searchPost');

        $posts = Post::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->get();

        return view('posts.search-post', compact('posts'));
    }
}
