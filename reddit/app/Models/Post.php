<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
       'name', 'content'
    ];

    public function communities () {
        return $this->belongsTo(Community::Class);
    }

    public function comments ()
    {
        return $this->hasMany(Comment::Class);
    }

    public function users() {
        return $this->belongsTo(User::Class);
    }
}
