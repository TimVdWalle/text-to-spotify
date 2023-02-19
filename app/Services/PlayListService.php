<?php

namespace App\Services;

use App\Models\Track;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PlayListService
{

    /**
     * @param string $text
     * @return void
     */
    public function saveToPlaylist(string $text){
        // split into tracks
        $parts = (new SearchService())->splitAndSearch($text);

        dd($parts);
    }
}
