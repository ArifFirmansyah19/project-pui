<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentKegiatan extends Model
{
    use HasFactory;

    protected $fillable = ['kegiatan_id', 'parent_id', 'nama', 'isi_komentar', 'is_admin'];

    public function replies()
    {
        return $this->hasMany(CommentKegiatan::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(CommentKegiatan::class, 'parent_id');
    }

    // menghitung semua balasan
    public function countAllReplies()
    {
        $count = $this->replies()->count();
        foreach ($this->replies as $reply) {
            $count += $reply->countAllReplies();
        }
        return $count;
    }
}
