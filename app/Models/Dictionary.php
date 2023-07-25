<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    use HasFactory;

    protected $fillable = [
        'word',
        'meaning',
        'picture',
    ];
    // make the many to many relationship using the pivot talbe dictionary_authors
    public function authors() {
        return $this->belongsToMany(Author::class, 'dictionary_authors');
    }
}
