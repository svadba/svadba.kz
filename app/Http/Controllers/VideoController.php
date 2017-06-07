<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Advert;


class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add_ajax(Request $request)
    {
        $this->validate($request, [
            'advert_id' => 'required|exists:adverts,id,user_id,' . $request->user()->id,
            'videoIds' => 'required|max:500'
        ]);

        $advert = Advert::findOrFail($request->advert_id);
        $videoIds = $request->videoIds;
        $ids_array = explode(',', $videoIds);
        $new_ids_array = [];
        if ($ids_array) {
            foreach ($ids_array as $ids):
                $create_ids = Video::create([
                    'name' => '',
                    'path' => 'https://www.youtube.com/embed/'.$ids,
                    'base_path' => 'https://youtu.be/'.$ids,
                    'youtube_video_id' => $ids,
                    'ext' => '',
                    'advert_id' => $advert->id
                ]);
                $new_ids_array[] = $create_ids;
            endforeach;
        }
        else{
            return json_encode(array(
                'result' => 'false',
                'error' => 'bad_ids_array'
            ));
        }

        return json_encode(array(
            'result' => 'true',
            'videos' => $new_ids_array
        ));

    }


    public function delete_ajax(Request $request)
    {
        $this->validate($request, [
            'advert_id' => 'required|exists:adverts,id,user_id,' . $request->user()->id,
            'video_id' => 'required|exists:videos,id'
        ]);

        $video = Video::findOrFail($request->video_id);

        $video_id = $video->id;

        if ($video->advert_id == $request->advert_id) {

            $video->delete();
        }
        else{
            return 'video_is_not_for_you';
        }

        return $video_id;
    }
}
