<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    //for eager load N+1 problem
    protected $with = ['category', 'instructor', 'comments'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function instructor() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
