<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Constat extends Model
{
    protected $fillable = ['name'];
    
    public function contractor()
    {
        $this->hasMany('App\Contractor');
    }
}
