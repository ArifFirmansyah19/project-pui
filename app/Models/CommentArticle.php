<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentArticle extends Model
{
    use HasFactory;

    protected $fillable = ['article_id', 'parent_id', 'nama', 'isi_komentar', 'is_admin'];

    public function replies()
    {
        return $this->hasMany(CommentArticle::class, 'parent_id')->with('replies');
    }

    public function parent()
    {
        return $this->belongsTo(CommentArticle::class, 'parent_id');
    }

    public function countAllReplies()
    {
        $count = $this->replies()->count();
        foreach ($this->replies as $reply) {
            $count += $reply->countAllReplies();
        }
        return $count;
    }
}
