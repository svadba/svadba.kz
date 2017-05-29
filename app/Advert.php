<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    protected $fillable = ['name', 'description', 'views', 'contractor_id', 'advert_categor_id', 'advert_stat_id', 'allow_type_id', 'rating', 'user_id', 'published_at'];
        
    public function contractor()
    {
        return $this->belongsTo('App\Contractor');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function advert_categor()
    {
        return $this->belongsTo('App\Advert_categor');
    }
    
    public function allow_type()
    {
        return $this->belongsTo('App\Allow_type');
    }
    
    public function advert_stat()
    {
        return $this->belongsTo('App\Advert_stat');
    }
    
    public function cits()
    {
        return $this->belongsToMany('App\Cit', 'advert_cits', 'advert_id', 'cit_id');
    }
    
    public function advert_cits()
    {
        return $this->hasMany('App\Advert_cit');
    }
    
    public function musics()
    {   
        
        return $this->hasMany('App\Music');
    }
    
    public function photos()
    {   
        
        return $this->hasMany('App\Photo');
    }
    
    public function videos()
    {   
        
        return $this->hasMany('App\Video');
    }
    
    public function advert_tops()
    {
        return $this->hasMany('App\Advert_top');
    }
    
    public function cit_tops()
    {
        return $this->hasMany('App\Cit_top');
    }

    public function photo_main()
    {
        $all_photos = Photo::where('advert_id', $this->id)->where('main', 1)->first();
        if($all_photos)
        {
            return 'upload/begests/thumbs/' .$all_photos->name. '.' .$all_photos->ext;
        }
        else {
            return 'images/no-avatar.png';
        }
    }
    
    
    
}
