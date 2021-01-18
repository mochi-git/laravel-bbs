<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    // 割り当て許可
    protected $fillable = [
        'name',
        'subject',
        'message', 
        'category_id'
    ];

    /**
     * 
     */
    public function comments()
    {
        // 投稿は複数のコメントを持つ
        return $this->hasMany('App\Models\Comment');
    }
 
    /**
     * 
     */
    public function category()
    {
        // 投稿は1つのカテゴリーに属する
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * 任意のカテゴリを含むものとする（ローカル）スコープ
     * 
     */
    public function scopeCategoryAt($query, $category_id)
    {
        if (empty($category_id)) {
            return;
        }
     
        return $query->where('category_id', $category_id);
    }

    /**
     * 「名前」検索スコープ
     */
    public function scopeFuzzyName($query, $searchword)
    {
        if (empty($searchword)) {
            return;
        }
        return $query->where('name', 'like', "%{$searchword}%");
    }

}
