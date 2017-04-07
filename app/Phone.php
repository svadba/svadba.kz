<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{   
    protected $fillable = ['name', 'phone', 'contractor_id'];
    public function contractor()
    {
        return $this->belongsTo('App\Contractor');
    }
    
}
