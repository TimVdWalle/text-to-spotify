<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use App\Services\TrackService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class V2Controller extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function show(): View|Factory|Application
    {
        $trackService = new TrackService();
//        $trackService->test();

        return view('v2');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function store(Request $request): View|Factory|Redirector|RedirectResponse|Application
    {
//        $searchService = new SearchService();

        $text = strval($request->get('text'));

        if (! $text) {
            return redirect(route('home'));
        }

        if (strlen(strval($text)) > 100) {
            return redirect(route('home'));
        }

        $searchService = new SearchService();
        $list = $searchService->splitAndSearch($text);

        return view('v2', [
            'text' => $text,
            'results' => $list,
        ]);
    }

    /**
     * @param Request $request
     * @return void
     */
    public function tokenstore(Request $request): void
    {
        if (isset($_GET['code'])) {
            $request->session()->put('spotify-token', $request->code);
        }
    }
}
