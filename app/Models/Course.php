<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = ['id','status'];

    public $withCount = ['students', 'reviews'];

    const BORRADOR = 1;
    const REVISION = 2;
    const PUBLICADO = 3;

    public function getRatingAttribute(){
        if($this->reviews_count){
            return round($this->reviews->avg('rating'),1);
        }else{
            return 5;
        }

    
    }

    public function getRouteKeyName()
    {
        return "slug";
    }

    //Relación uno a muchos
    public function reviews(){
        return $this->hasMany('App\Models\Review');
    }

    public function goals(){
        return $this->hasMany('App\Models\Goal');
    }

    public function audience(){
        return $this->hasMany('App\Models\Audience');
    }
    
    public function sections(){
        return $this->hasMany('App\Models\Section');
    }

    //RELACIÓN UNO A MUCHOS INVESRA
    public function teacher(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function level(){
        return $this->belongsTo('App\Models\Level');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function price(){
        return $this->belongsTo('App\Models\Price');
    }

    //RELACIÓN UNO A MUCHOS 
    public function students(){
        return $this->belongsToMany('App\Models\User');
    }

    //Relación uno a uno polimorfica
    public function image(){
        return $this->morphOne('App\Models\Image','imageable');
    }

    //Relación cursos con lecciones
    public function lessons(){
        return $this->hasManyThrough('App\Models\Lesson', 'App\Models\Section');
    }
}
