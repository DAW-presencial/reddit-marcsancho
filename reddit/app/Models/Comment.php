<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content'
    ];

    public function posts() {
        return $this->belongsTo(Post::Class);
    }

    public function users() {
        return $this->belongsTo(User::Class);
    }
}
