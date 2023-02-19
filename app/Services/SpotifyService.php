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
    /**
     * @var int
     */
    protected int $triesPerMarket = 4;

    /**
     * @var int
     */
    protected int $limitPerTry = 50;

    // search several markets until $term is found or until maximum tries have been reached
    // return result or null (if not found)
    /**
     * @param string $term
     * @return mixed|void
     *
     * @throws \Aerni\Spotify\Exceptions\SpotifyApiException
     * @throws \Aerni\Spotify\Exceptions\ValidatorException
     */
    public function search(string $term)
    {
        $markets = [
            'BE',
            'US',
            //            "NL",
            //            "GB",
            //            "FR",
            //            "DE",
        ];

        // try different markets because sometimes a song only exist on certain market, not in others
        // limit the times we search with $triesPerMarket
        for ($try = 0; $try < $this->triesPerMarket; $try++) {
            foreach ($markets as $market) {
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

    /**
     * @return bool
     */
    public function hasToken()
    {
        $token = session('spotify-token');
        if (!$token) {
            return false;
        };

        return true;
    }

    /**
     * @return void
     */
    public function getApi()
    {
        $session = $this->getSession();
//        $api = new SpotifyWebAPI();
//
//        if ($token) {
//            $session->requestAccessToken(strval($token));
//            $api->setAccessToken($session->getAccessToken());
//
////            print_r($api->me());
//        } else {
//            return null;
//        }
    }

    /**
     * @return void
     */
    public function redirectToGetToken()
    {
        $session = $this->getSession();
        $options = [
            'scope' => [
                'user-read-email',
            ],
        ];

//        dd($session->getAuthorizeUrl($options));

        header('Location: ' . $session->getAuthorizeUrl($options));
        exit();
    }

    /**
     * @return Session
     */
    private function getSession()
    {
        $session = new Session(
            strval(config('spotify.auth.client_id')),
            strval(config('spotify.auth.client_secret')),
            strval(config('spotify.auth.redirect_url')),
        );

        return $session;
    }
}
