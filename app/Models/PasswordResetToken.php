<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    use HasFactory;

    protected $table = 'password_resets';
    protected $primaryKey = 'email';
    public $timestamps = false;

    public $fillable = [
        'email',
        'token',
        'created_at',
    ];
}