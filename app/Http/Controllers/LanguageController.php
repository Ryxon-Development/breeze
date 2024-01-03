<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    function dutch()
    {
        session()->put('locale', 'nl');
        return redirect()->back();
    }

    function english()
    {
        session()->put('locale', 'en');
        return redirect()->back();
    }
}
