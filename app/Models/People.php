<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;


    protected $fillable = [
        'firstname',
        'lastname',
        'birthdate',
        'address',
        'zip',
        'city',
        'phone',
        'email',
        'country_id'
    ];


    protected $hidden = ['created_at', 'updated_at'];



    public function Countries()
    {
        return $this->hasMany(Country::class);
    }

    public function Books()
    {
        return $this->belongsToMany(Book::class);
    }
}
