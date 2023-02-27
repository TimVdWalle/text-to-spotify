<?php

namespace App\Services;

use Aerni\Spotify\Spotify;
use SpotifyWebAPI\Session;
use SpotifyWebAPI\SpotifyWebAPI;

/*
 * this service uses 2 libraries to talk to the spotify api
 *      Aerni\Spotify\Spotify : can talk to the spotify api without user tokens: just used to search for tracks
 *      SpotifyWebAPI : can talk to spotify api with user tokens: used for creating playlists for user
 *          (jwilsson/spotify-web-api-php)
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

    /**
     * @param  string  $term
     * @return mixed|void
     *
     * @throws \Aerni\Spotify\Exceptions\SpotifyApiException
     * @throws \Aerni\Spotify\Exceptions\ValidatorException
     * search several markets until $term is found or until maximum tries have been reached
     * return result or null (if not found)
     */
    public function search(string $term)
    {
//        $foundResults = collect();

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
//                            dd($searchResult);

                            return $searchResult;
//                            $foundResults->push($searchResult);
                        }
                    }
                }
            }
        }

//        return $foundResults;
    }

    /**
     * @return bool
     */
    public function hasAccessToken()
    {
        $token = session('spotify-access-token');
        $lastActivity = session('last-activity');

        if (! $token || ! $lastActivity || (time() - $lastActivity > (60 * 60))) {
            return false;
        }

        return true;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    public function getAccessToken()
    {
        if (! $this->hasAccessToken()) {
            return null;
        }

        $token = session('spotify-access-token');

        return $token;
    }

    /**
     * @return SpotifyWebAPI|null
     */
    public function getApi(): ?SpotifyWebAPI
    {
        $session = $this->getSpotifySession();
        $api = new SpotifyWebAPI();

        $accesstoken = $this->getAccessToken();

//        dd('$accesstoken', $accesstoken);

        if ($accesstoken) {
//            $session->requestAccessToken(strval($accesstoken));
            $api->setAccessToken(strval($accesstoken));

            return $api;
        } else {
            return null;
        }
    }

    /**
     * @param  string  $token
     * @return void
     */
    public function getAndStoreAccessToken(string $token)
    {
        $session = $this->getSpotifySession();
        $api = new SpotifyWebAPI();

        $session->requestAccessToken(strval($token));
        $accessToken = $session->getAccessToken();

        $api->setAccessToken($accessToken);

//        print_r($api->me());
//        dd('done');

        request()->session()->put('spotify-access-token', $accessToken);
        request()->session()->put('last-activity', time());

        $redirectTo = session('redirectTo');
        header('Location: '.$redirectTo);
    }

    /**
     * @return void
     */
    public function redirectToGetToken()
    {
        $session = $this->getSpotifySession();
        $options = [
            'scope' => [
                'playlist-modify-public',
            ],
        ];

//        dd($session->getAuthorizeUrl($options));

        header('Location: '.$session->getAuthorizeUrl($options));
        exit();
    }

    /**
     * @return Session
     */
    private function getSpotifySession()
    {
        $session = new Session(
            strval(config('spotify.auth.client_id')),
            strval(config('spotify.auth.client_secret')),
            strval(config('spotify.auth.redirect_url')),
        );

        return $session;
    }
}
