<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;

class LanguageController extends Controller
{
    public function setlang($lang)
    {
        if (! in_array($lang, config('app.supported_languages'))) {
            abort(400);
        }
    
        //App::setLocale($lang);
        session(['app_locale' => $lang]);
        return redirect()->back();
    }
}
