<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $primaryKey = 'isbn';
    public $incrementing = false;
    // protected $keyType = 'number';

    protected $fillable = [
        'isbn',
        'title',
        'year',
        'summary',
        'etat',
        'statut'
    ];


    protected $hidden = ['created_at', 'updated_at'];


    public function Authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function People()
    {
        return $this->belongsToMany(People::class);
    }

    public function Categories()
    {
        return $this->hasMany(Category::class, 'category_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class,'imageable');
    }



}
