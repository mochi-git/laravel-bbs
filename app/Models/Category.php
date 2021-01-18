<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    /**
     * 
     */
    public function posts()
    {
        // カテゴリは複数のポストを持つ
        return $this->hasMany('App\Models\Post');
    }

    /**
	 * カテゴリーの一覧を取得
	 */
	public function getLists()
	{
	    $categories = Category::orderBy('id','asc')->pluck('name', 'id');
	 
	    return $categories;
	}
}
