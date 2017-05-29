<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class PhotoController extends Controller
{
    public function delete(Photo $photo)
    {
        if($photo->main)
        {
            Storage::disk('public_my')->delete('upload/begests/thumbs/' .$photo->name. '.' .$photo->ext);
            Storage::disk('public_my')->delete($photo->path);
            $advert_id = $photo->advert_id;
            $photo->delete();
            $next_file = Photo::where('advert_id', $advert_id)->first();
            if($next_file)
            {
                $next_file->main = 1;
                $next_file->save();
                $image = Image::make($next_file->path);
                $image->fit(290)->save('upload/begests/thumbs/' .$next_file->name. '.' .$next_file->ext);
            }
        }
        else{
            Storage::disk('public_my')->delete($photo->path);
            $photo->delete();
        }

        return redirect()->back();
    }

    public function set_main(Photo $photo)
    {
        if($photo->main) return redirect()->back();

        $all_photos = Photo::where('advert_id', $photo->advert_id)->where('main', 1)->get();
        If(count($all_photos))
        {
            foreach($all_photos as $phot):
                Storage::disk('public_my')->delete('upload/begests/thumbs/' .$phot->name. '.' .$phot->ext);
                $phot->main = 0;
                $phot->save();
            endforeach;
        }
        $photo->main = 1;
        $photo->save();
        $image = Image::make($photo->path);
        $image->fit(290)->save('upload/begests/thumbs/' .$photo->name. '.' .$photo->ext);
        return redirect()->back();
    }
}
