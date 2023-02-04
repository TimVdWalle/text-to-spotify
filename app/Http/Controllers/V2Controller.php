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

        $results = collect();
        $spotifyService = new SpotifyService();
        foreach ($parts as $part) {
            $result = $spotifyService->search($part);
            $results->push($result);
        }

        $list = $results->map(function($item){
            if($item){
                $artist = array_map(function($artistArray){
                    return $artistArray['name'];

                }, $item['artists']);
                $name = $item['name'];
            } else {
                $artist = [''];
                $name = '';
            }

            return [
               'name' => $name,
               'artist' => $artist,
           ];
        });

        return view('v2', [
            'text' => $text,
            'results' => $list,
        ]);

    }

    public function tokenstore(Request $request){
        if (isset($_GET['code'])) {
            $request->session()->put('spotify-token', $request->code);
        }
    }
}
