<?php

namespace App\Http\Controllers;

use App\Services\PlayListService;
use App\Services\SearchService;
use App\Services\SearchServiceV4;
use App\Services\SpotifyService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class V4Controller extends Controller
{

    const VERSION = 'v4';
    /**
     * @return View|Factory|Application
     */
    public function show(): View|Factory|Application
    {
        return view(self::VERSION);
    }

    /**
     * @param  Request  $request
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function store(Request $request): View|Factory|Redirector|RedirectResponse|Application
    {
        $text = strval($request->get('text'));

        if (! $text) {
            return redirect(route('home'));
        }

        if (strlen(strval($text)) > 100) {
            return redirect(route('home'));
        }

        $searchService = new SearchServiceV4();
        $list = $searchService->splitAndSearch($text);

        return view(self::VERSION, [
            'text' => $text,
            'results' => $list,
        ]);
    }

    /**
     * @param  Request  $request
     * @return void
     */
    public function playliststore(Request $request)
    {
        $text = strval($request->get('text'));

        $spotifyService = new SpotifyService();
        if ($spotifyService->hasAccessToken()) {
            $playListService = new PlayListService();
            $playListService->saveToPlaylist($text);
        } else {
            // save url to redirect to when coming back from spotify
            $redirectToUrl = route(self::VERSION.'playlist.store', ['text' => $text]);
//            $request->session()->put('redirectTo', $redirectToUrl);
            session(['redirectTo' => $redirectToUrl]);
            $request->session()->save();

//            dd('going to spotify');
            $spotifyService->redirectToGetToken();
        }
    }

    /**
     * @param  Request  $request
     * @return void
     */
    public function tokenstore(Request $request): void
    {
        if (isset($_GET['code'])) {
            $spotifyService = new SpotifyService();
            $spotifyService->getAndStoreAccessToken(strval($request->code));
        }
    }}
