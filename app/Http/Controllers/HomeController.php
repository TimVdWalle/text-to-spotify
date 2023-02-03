<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Aerni\Spotify\Spotify;


class HomeController extends Controller
{
    public function home()
    {
        return view('home');
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
                ->limit(10)
                ->offset(0)
                ->get();

            if(isset($searchResults['tracks']) && isset($searchResults['tracks']['items'])){
                foreach($searchResults['tracks']['items'] as $searchResult){

                    if(strcasecmp($searchResult['name'], $part)){
                        $result = [$part => $searchResult['id']];

                        $results->push($result);
                        break;
                    }
                }
            }

        }
        dd($results);


    }
}
