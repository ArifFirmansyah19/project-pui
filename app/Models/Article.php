<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Models\CommentArticle;

class Article extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'judul',
        'penulis',
        'foto_artikel',
        'abstract',
        'file_path',
    ];


    public function comments()
    {
        return $this->hasMany(CommentArticle::class, 'article_id');
    }

    // Accessor for formatted created_at
    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d-m-Y');
    }

    public function getTotalCommentsAttribute()
    {
        return $this->totalMainComments + $this->totalReplies;
    }
}
