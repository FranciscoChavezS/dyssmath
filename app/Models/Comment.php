<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function commentable(){
        return $this->morphTo();
    }

    //Relación uno a muchos polimorfica
    public function comments(){
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    //Relación uno a muchos polimorfica
    public function reactions(){
        return $this->morphMany('App\Models\Reaction', 'reactionable');
    }
}
