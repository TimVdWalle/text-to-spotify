<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class HomeController extends Controller
{
    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function home()
    {
        return redirect(route('v4.show'));
    }
}
