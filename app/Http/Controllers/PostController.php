<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostEditRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $posts = Post::with('category')->latest()->paginate(5);

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
     * @param PostCreateRequest $request
     * @return RedirectResponse
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
     * @param Post $post
     * @return Application|Factory|View
     * @throws \JsonException
     */
    public function show(Post $post)
    {
//        $cachedBlog = Redis::get('post_' . $post->id);
//
//        if(isset($cachedBlog)) {
//            $blog = json_decode($cachedBlog, FALSE, 512, JSON_THROW_ON_ERROR);
//
//            return response()->json([
//                'status_code' => 201,
//                'message' => 'Fetched from redis',
//                'data' => $blog,
//            ]);
//        }else {
//            $blog = Post::find($post->id);
//            Redis::set('post_' . $post->id, $blog);
//            return response()->json([
//                'status_code' => 201,
//                'message' => 'Fetched from database',
//                'data' => $blog,
//            ]);
//        }
        $countLike = $post->likes()->count();
        $countDislike = $post->dislikes()->count();

        return view('posts.show', [
            'post' => $post,
            'category' => $post->category->name,
            'countLike' => $countLike,
            'countDislike' => $countDislike
        ]);
    }

    /**
     *
     * @param Post $post
     * @return Application|Factory|View
     */
    public function edit(Post $post)
    {
        $categories = Category::all();

        return view('posts.edit', compact('categories', 'post'));
    }

    /**
     *
     * @param PostEditRequest $request
     * @param Post $post
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(PostEditRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $input = $post->uploadPicture($request);
        $post->fill($input)->save();
        $post->like(1)->save($post);
        session()->flash('status', 'Post was updated Successfully');

        return redirect()->route('posts.index');
    }

    /**
     *
     * @param Post $post
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
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

    public function like(Request $request, Post $post)
    {
        $this->authorize('like', $post);
        auth()->user()->like($post);

        return redirect()->route('home')->with('status', 'You like Successfully');
    }
//
//    public function unlike(Request $request, Post $post)
//    {
//        $this->authorize('update', $post);
//        auth()->user()->unlike($post);
//
//        return redirect()->route('home')->with('status', 'You unlike Successfully');
//    }

    public function dislike(Request $request, Post $post)
    {
        $this->authorize('like', $post);
        auth()->user()->dislike($post);

        return redirect()->route('home')->with('status', 'You dislike Successfully');
    }
}
