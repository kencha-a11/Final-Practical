<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'users_id',
    ];

    // In Post.php (Model)
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
