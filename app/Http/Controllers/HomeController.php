<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $posts = Post::latest()->take(10)->get();
        $categories = Category::all();

        return view('home', compact('posts', 'categories'));
    }

    /**
     * @return Application|Factory|View
     */
    public function about()
    {
        return view('about');
    }

    /**
     * @return Application|Factory|View
     */
    public function contact()
    {
        return view('contact');
    }
}
