<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function home()
    {
        return redirect(route('v2.show'));
    }
}
