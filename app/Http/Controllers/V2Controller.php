<?php

namespace App\Http\Controllers;

use App\Services\SpotifyService;
use Illuminate\Http\Request;
use Aerni\Spotify\Spotify;


class V2Controller extends Controller
{
    public function show()
    {
        return view('v2');
    }

    public function store(Request $request)
    {
        $text = $request->get('text');

        if (!$text) {
            return redirect(route('home'));
        }

        if (strlen($text) > 100) {
            return redirect(route('home'));
        }

        $parts = explode(" ", $text);
        if (count($parts) > 10) {
            return redirect(route('home'));
        }

        $spotify = new Spotify(config('spotify.default_config'));

        $results = collect();
        foreach ($parts as $part) {
            $searchResults = $spotify
                ->searchTracks($part)
                ->limit(50)
                ->offset(0)
                ->get();

            if (isset($searchResults['tracks']) && isset($searchResults['tracks']['items'])) {
                foreach ($searchResults['tracks']['items'] as $searchResult) {

                    if (strtolower($searchResult['name']) == strtolower($part)) {
                        $artist = array_map(function($artistArray){
                            return $artistArray['name'];

                        }, $searchResult['artists']);

                        $result = [
                            'id' => $searchResult['id'],
                            'name' => $searchResult['name'],
                            'artist' => $artist,
                        ];

                        $results->push($result);
                        break;
                    } else {
//                        dd($searchResult['name']);
                    }
                }
            }

        }


        return view('v1', [
            'text' => $text,
            'results' => $results,
        ]);

    }

    public function tokenstore(Request $request){
        if (isset($_GET['code'])) {
            $request->session()->put('spotify-token', $request->code);
        }
    }
}
