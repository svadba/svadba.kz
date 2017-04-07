<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{   
    protected $fillable = ['name', 'surname', 'middlename', 'email' ,'birthday', 'address', 'ava_path', 'constat_id', 'contype_id'];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function phones()
    {   
        return $this->hasMany('App\Phone');
    }
    
    public function contype()
    {
        return $this->belongsTo('App\Contype');
    }
    
    public function constat()
    {
        return $this->belongsTo('App\Constat');
    }
    
    public function adverts()
    {   
        return $this->hasMany('App\Advert');
    }
}
