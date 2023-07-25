<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'email',
    ];
    // make the many to many relationship using the pivot talbe dictionary_authors
    public function dictionaries() {
        return $this->belongsToMany(Dictionary::class, 'dictionary_authors');
    }
}
