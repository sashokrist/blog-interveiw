<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        if (Auth::check()) {
            $id = auth()->user()->id;
            $profile = Profile::where('user_id', $id)->first();
        } else{
            $profile = null;
        }
        $posts = Post::where('id', auth()->user()->id)->get();

        return view('profile', compact('profile', 'posts'));

    }

}
