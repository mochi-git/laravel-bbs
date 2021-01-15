<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // ←★忘れず追記
use App\Http\Requests\PostRequest;

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

	/**
	 * 投稿フォーム
	 */
	public function create()
	{
	 	return view('bbs.create');
	}
	 
	 
	/**
	 * バリデーション、登録データの整形など
	 */
	public function store(PostRequest $request)
	{
	    $savedata = [
	        'name' => $request->name,
	        'subject' => $request->subject,
	        'message' => $request->message,
	        'category_id' => $request->category_id,
	    ];
	 
	    $post = new Post;
	    $post->fill($savedata)->save();
	 
	    return redirect('/bbs')->with('poststatus', '新規投稿しました');
	}

	/**
	 * 編集画面
	 */
	public function edit($post_id)
	{
	    $post = Post::findOrFail($post_id);
	    return view('bbs.edit', ['post' => $post]);
	}
 
 
	/**
	 * 編集実行
	 */
	public function update($post_id, PostRequest $request)
	{
	    $savedata = [
	        'name' => $request->name,
	        'subject' => $request->subject,
	        'message' => $request->message,
	        'category_id' => $request->category_id,
	    ];
	 
	    //$post = new Post;
	    $post = Post::findOrFail($post_id);
	    $post->fill($savedata)->save();
	 
	    return redirect('/bbs')->with('poststatus', '投稿を編集しました');
	}

	/**
	 * 物理削除
	 */
	public function destroy($id)
	{
		$post = Post::findOrFail($id);

		$post->comments()->delete(); // ←★コメント削除実行
		$post->delete();  // ←★投稿削除実行

		return redirect('/bbs')->with('poststatus', '投稿を削除しました');
	}

}
