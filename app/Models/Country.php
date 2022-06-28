<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;


    protected $primaryKey = 'iso';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        
        'name',
        'description'
    ];
    // protected $primaryKey = 'iso';


    protected $hidden = ['created_at', 'updated_at'];


    public function Authors()
    {
        return $this->belongsTo(Authors::class);
    }

    public function People()
    {
        return $this->belongsTo(People::class);
    }




}
