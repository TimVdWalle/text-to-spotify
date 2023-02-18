<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use App\Services\TrackService;
use Illuminate\Http\Request;


class V2Controller extends Controller
{
    public function show()
    {

        $trackService = new TrackService();
//        $trackService->test();

        return view('v2');
    }

    public function store(Request $request)
    {

//        $searchService = new SearchService();

        $text = $request->get('text');

        if (!$text) {
            return redirect(route('home'));
        }

        if (strlen($text) > 100) {
            return redirect(route('home'));
        }

        $searchService = new SearchService();
        $list = $searchService->splitAndSearch($text);

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
