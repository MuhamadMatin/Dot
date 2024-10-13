<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $users = User::select('id')
            ->count();
        $posts = Post::select('id')
            ->count();
        return view('index', compact('users', 'posts'));
    }
}
