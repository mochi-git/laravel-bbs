<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post, App\Models\Category;  // 「Category」を追記
use App\Http\Requests\PostRequest;

class PostsController extends Controller
{
    /**
	 * 一覧
	 */
	public function index(Request $request)
	{
	    // カテゴリ取得
	    $category = new Category;
	    $categories = $category->getLists();
	 
	    $category_id = $request->category_id;
	    $posts = Post::with('comments', 'category')        // ←★これ
		->orderBy('created_at', 'desc')
		->categoryAt($category_id)
		->paginate(10);
	 
	    return view('bbs.index', [
	        'posts' => $posts, 
	        'categories' => $categories, 
	        'category_id'=>$category_id
	    ]);
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
	    $category = new Category;
	    $categories = $category->getLists()->prepend('選択', '');
	 
	    return view('bbs.create', ['categories' => $categories]);
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

	    $category = new Category;
	    $categories = $category->getLists();

	    $post = Post::findOrFail($post_id);
    	return view('bbs.edit', ['post' => $post, 'categories' => $categories]);
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
