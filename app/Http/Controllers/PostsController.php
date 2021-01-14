<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // ←★忘れず追記

class PostsController extends Controller
{
    //
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('bbs.index', ['posts' => $posts]);
    }
}
