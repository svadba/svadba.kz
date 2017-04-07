<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['name', 'path', 'base_path', 'youtube_video_id', 'ext', 'advert_id'];
    
    public function advert()
    {
        return $this->belongsTo('App\Advert');
    }
}
