<?php
//can skip to make this model since it is a pivot table
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DictionaryAuthor extends Model
{
    use HasFactory;

    public $table = 'dictionary_author';
    // protected $fillable = [
    //     'author_id',
    //     'dictionary_id',
    // ];
}
