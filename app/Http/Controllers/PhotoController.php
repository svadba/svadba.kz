<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class PhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function delete(Photo $photo)
    {
        if ($photo->main) {
            Storage::disk('public_my')->delete('upload/begests/thumbs/' . $photo->name . '.' . $photo->ext);
            Storage::disk('public_my')->delete($photo->path);
            $advert_id = $photo->advert_id;
            $photo->delete();
            $next_file = Photo::where('advert_id', $advert_id)->first();
            if ($next_file) {
                $next_file->main = 1;
                $next_file->save();
                $image = Image::make($next_file->path);
                $image->fit(290)->save('upload/begests/thumbs/' . $next_file->name . '.' . $next_file->ext);
            }
        } else {
            Storage::disk('public_my')->delete($photo->path);
            $photo->delete();
        }

        return redirect()->back();
    }

    public function set_main(Photo $photo)
    {
        if ($photo->main) return redirect()->back();

        $all_photos = Photo::where('advert_id', $photo->advert_id)->where('main', 1)->get();
        If (count($all_photos)) {
            foreach ($all_photos as $phot):
                Storage::disk('public_my')->delete('upload/begests/thumbs/' . $phot->name . '.' . $phot->ext);
                $phot->main = 0;
                $phot->save();
            endforeach;
        }
        $photo->main = 1;
        $photo->save();
        $image = Image::make($photo->path);
        $image->fit(290)->save('upload/begests/thumbs/' . $photo->name . '.' . $photo->ext);
        return redirect()->back();
    }

    public function ajax_set_advert_miniature(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|file|mimes:jpg,png,jpeg',
            'whois' => 'required|exists:adverts,id,user_id,' . $request->user()->id,
            'x' => 'required|numeric',
            'y' => 'required|numeric',
            'w' => 'required|numeric',
            'h' => 'required|numeric',
        ]);

        $photo_upload = $request->image;
        IF ($photo_upload->isValid()) {
            IF ($photo_upload->getClientSize() <= 20 * 1024 * 1024) {

                $advert_id = $request->whois;
                $photos = Photo::where('advert_id', $request->whois)->get();

                foreach ($photos as $photo):
                    if ($photo->main) {
                        Storage::disk('public_my')->delete('upload/begests/thumbs/' . $photo->name . '.' . $photo->ext);
                        $photo->main = 0;
                        $photo->save();
                    }
                endforeach;

                $directory = 'upload/begests/' . $advert_id;
                $extension = $photo_upload->guessExtension();
                $name = str_random(10) . $advert_id;
                $photo_upload->move($directory . '/photos/', $name . '.' . $extension);

                $saved_file = Photo::create([
                    'name' => $name,
                    'path' => $directory . '/photos/' . $name . '.' . $extension,
                    'ext' => $extension,
                    'advert_id' => $advert_id,
                    'main' => 1,
                ]);

                $targ_w = $targ_h = 450;
                $jpeg_quality = 90;

                $src = $saved_file->path;
                $img_r = imagecreatefromjpeg($src);
                $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
                imagecopyresampled($dst_r,$img_r,0,0,$request->x,$request->y,$targ_w,$targ_h,$request->w,$request->h);
                imagejpeg($dst_r,'upload/begests/thumbs/'.$name.'.'.$extension, $jpeg_quality);


                return json_encode([
                    "result" => true,
                    "photo" => $saved_file
                ]);
            }
        }
    }
}
