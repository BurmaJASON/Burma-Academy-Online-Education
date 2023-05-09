<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['author'];


    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function author() {
        return $this->belongsTo(User::class,'user_id');
    }

}
