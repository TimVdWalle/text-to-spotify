<?php

namespace App\Services;

use Aerni\Spotify\Spotify;
use SpotifyWebAPI\Session;
use SpotifyWebAPI\SpotifyWebAPI;


/*
 * this service uses 2 libraries to talk to the spotify api
 *      Aerni\Spotify\Spotify : can talk to the spotify api without user tokens: just used to search for tracks
 *      SpotifyWebAPI : can talk to spotify api with user tokens: used for creating playlists for user
 */
class SpotifyService
{
    protected int $triesPerMarket = 5;
    protected int $limitPerTry = 10;

    public function search(string $term){
        $markets = [
            "BE",
            "US",
            "NL",
            "GB",
            "FR",
            "DE",
        ];

        for($try = 0; $try < $this->triesPerMarket; $try++){
            foreach($markets as $market){
                $config = [
                    'country' => null,
                    'locale' => null,
                    'market' => $market,
                ];

                $spotify = new Spotify($config);
                $searchResults = $spotify
                    ->searchTracks($term)
                    ->limit($this->limitPerTry)
                    ->offset($this->limitPerTry * $try)
                    ->get();

                // check if the searchresults containt the term that was searched for ...
                if (isset($searchResults['tracks']) && isset($searchResults['tracks']['items'])) {
                    foreach ($searchResults['tracks']['items'] as $searchResult) {
                        if (strtolower($searchResult['name']) == strtolower($term)) {
                            return $searchResult;
                        }
                    }
                }
            }
        }
    }

    public function test(){
        $session = new Session(
            config('spotify.auth.client_id'),
            config('spotify.auth.client_secret'),
            config('spotify.auth.redirect_url'),
        );

        $api = new SpotifyWebAPI();
        $token = session('spotify-token');

        if ($token) {
            $session->requestAccessToken($token);
            $api->setAccessToken($session->getAccessToken());

            print_r($api->me());
        } else {
            $options = [
                'scope' => [
                    'user-read-email',
                ],
            ];

            header('Location: ' . $session->getAuthorizeUrl($options));
            die();
        }
    }
}
