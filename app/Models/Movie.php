<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'city_id',
    ];

    public function actors(){
        return $this->belongsToMany(Actor::class, 'movie_actors');
    }

    public function genras(){
        return $this->belongsToMany(Genra::class, 'movie_genras');
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

   
}
