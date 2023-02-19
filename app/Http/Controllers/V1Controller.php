<?php

namespace App\Http\Controllers;

use Aerni\Spotify\Spotify;
use Illuminate\Http\Request;

class V1Controller extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show()
    {
        return view('v1');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Aerni\Spotify\Exceptions\SpotifyApiException
     * @throws \Aerni\Spotify\Exceptions\ValidatorException
     */
    public function store(Request $request)
    {
        $text = strval($request->get('text'));

        if (!$text) {
            return redirect(route('home'));
        }

        if (strlen($text) > 100) {
            return redirect(route('home'));
        }

        $parts = explode(' ', $text);
        if (count($parts) > 10) {
            return redirect(route('home'));
        }

        $spotify = new Spotify((array)config('spotify.default_config'));

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
                        $artist = array_map(function ($artistArray) {
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
}
