<?php

namespace App\Services;

use App\Models\Track;
use Illuminate\Support\Collection;

class PlayListService
{
    /**
     * @param  string  $text
     * @return void
     */
    public function saveToPlaylist(string $text)
    {
        // split into tracks
        $parts = (new SearchService())->splitAndSearch($text);

        $playListName = $parts->first()['name'];        /* @phpstan-ignore-line */

        /** @var Collection<int, Track> $tracks */
        $tracks = $parts->map(function ($part) {
            return TrackService::get($part['name']);
        })->map(function ($track) {
            return $track->track['id'] ?? 0;        /* @phpstan-ignore-line */
        });

        $api = (new SpotifyService())->getApi();

        if (! $api) {
            return;
        }

        $playlistOptions = [
            'name' => $playListName,
            'collaborative' => false,
            'description' => 'Playlist created from text2spotify.vandewalle.mobi ('.config('app.url').')',
            'public' => true,
        ];

        $result = $api->createPlaylist($playlistOptions);

        $api->addPlaylistTracks($result->id, $tracks->toArray());       /* @phpstan-ignore-line */

//        dd($result->id, $result);

//        array|object $options – Options for the new playlist.
//        - string name Required. Name of the playlist.
//        - bool collaborative Optional. Whether the playlist should be collaborative or not.
//        - string description Optional. Description of the playlist.
//        - bool public Optional. Whether the playlist should be public or not

        echo 'playlist created!';
    }
}
