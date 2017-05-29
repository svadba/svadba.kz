<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Music;
use App\Advert;
use Illuminate\Support\Facades\Storage;


class MusicController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save_ajax(Request $request)
    {
        $this->validate($request, [
            'advert_id' => 'required|exists:adverts,id,user_id,' . $request->user()->id,
            'music' => 'required|mimes:mpga|file'
        ]);

        $advert = Advert::findOrFail($request->advert_id);
        $music = $request->music;
        IF ($request->hasFile('music')) {
            $musics = Music::where('advert_id', $advert->id)->get();
            $count = count($musics);
            $directory = 'upload/begests/' . $advert->id;
            $extension = 'mp3';
            IF ($music->isValid()) {
                IF ($music->getClientSize() <= 20 * 1024 * 1024) {
                    $name = str_random(4) . '_' . $advert->id . '_' . ++$count;
                    $music->move($directory . '/musics/', $name . '.' . $extension);
                    $saved_file = Music::create([
                        'name' => $name,
                        'path' => $directory . '/musics/' . $name . '.' . $extension,
                        'ext' => $extension,
                        'advert_id' => $advert->id
                    ]);
                } else {
                    return json_encode(array(
                        'result' => 'false',
                        'error' => 'size'
                    ));
                }
            } else {
                return json_encode(array(
                    'result' => 'false',
                    'error' => 'valid'
                ));
            }
        } else {
            return json_encode(array(
                'result' => 'false',
                'error' => 'no_has'
            ));
        }

        return json_encode(array(
            'result' => 'true',
            'music' => $saved_file
        ));
    }


    public function delete_ajax(Request $request)
    {
        $this->validate($request, [
            'advert_id' => 'required|exists:adverts,id,user_id,' . $request->user()->id,
            'music_id' => 'required|exists:musics,id'
        ]);

        $music = Music::findOrFail($request->music_id);

        $music_id = $music->id;
        if ($music->advert_id == $request->advert_id) {

            Storage::disk('public_my')->delete($music->path);
            $music->delete();
        }
        return $music_id;
    }


}
