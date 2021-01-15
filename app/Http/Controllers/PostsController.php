<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // ←★忘れず追記

class PostsController extends Controller
{
    //
    public function index()
    {
        //$posts = Post::orderBy('created_at', 'desc')->get();
        //ページ送り
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('bbs.index', ['posts' => $posts]);
    }

    /**
	 * 詳細
	 */
	public function show(Request $request, $id)
	{
	    $post = Post::findOrFail($id);
	 
	    return view('bbs.show', [
	        'post' => $post,
	    ]);
	}

}
