<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genra extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'description',
    ];

    public function movies(){
        return $this->belongsToMany(Movie::class, 'movie_genras');
    }
}
