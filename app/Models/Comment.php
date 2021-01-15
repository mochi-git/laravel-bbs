<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // 割り当て許可
    protected $fillable = [
		'post_id',
		'name',
		'comment', 
    ];

    /**
     * 
     */
    public function post()
    {
        // コメントは1つの投稿に所属する
        return $this->belongsTo('App\Models\Post');
    }
}
