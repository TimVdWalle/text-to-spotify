<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use App\Services\SpotifyService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class V3Controller extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function show(): View|Factory|Application
    {
        return view('v3');
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

        $searchService = new SearchService();
        $list = $searchService->splitAndSearch($text);

        return view('v3', [
            'text' => $text,
            'results' => $list,
        ]);
    }

    public function playliststore(Request $request){
        $text = strval($request->get('text'));

        $spotifyService = new SpotifyService();



    }

    /**
     * @param  Request  $request
     * @return void
     */
    public function tokenstore(Request $request): void
    {
        if (isset($_GET['code'])) {
            $request->session()->put('spotify-token', $request->code);
        }
    }
}
