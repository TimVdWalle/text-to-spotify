<?php

namespace App\Services;

use App\Models\Track;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TrackService
{
    /**
     * @return void
     */
    public function test()
    {
        dd('test');
    }


    /**
     * @param string $part
     * @return ?Track
     */
    public static function get(string $part)
    {
        /** @var Track $track */
        $track = Track::query()
            ->where('track_name', '=', $part)
            ->first();

        return $track;
    }

    /**
     * @param Track $track
     * @return bool
     */
    public static function isValid(Track $track): bool
    {
        $isValid =  $track !== null && $track->track !== null && !empty($track->track);

//        if($track->track_name == 'is kevin'){
//            dd($track, $isValid);
//        }

        return $isValid;
    }

    /**
     * @param string $part
     * @param object $searchResult
     * @return Track
     */
    public static function store(string $part, object $searchResult){
        $existingTrack = self::get($part);

        if($existingTrack){
            $existingTrack->track = $searchResult;
            $existingTrack->save();

            return $existingTrack;
        } else {
            $newTrack = new Track();
            $newTrack->track_name = $part;
            $newTrack->track = $searchResult;
            $newTrack->save();

            return $newTrack;
        }
    }
}
