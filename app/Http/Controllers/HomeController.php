<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Pratiksh\Nepalidate\Facades\NepaliDate;

use Illuminate\Support\Facades\App;
use Prologue\Alerts\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = Auth::user();
        $date = $user->created_at;
        $englishDate = $date->format('F d, Y');
        $nepaliDate = toFormattedNepaliDate($date);

        // toBS(\Carbon\Carbon::now()); // 2078-4-21
        // toFormattedBSDate(\Carbon\Carbon::now()); // 21 Shrawan 2078, Thurday
        // toFormattedNepaliDate(\Carbon\Carbon::now()); // २१ साउन २०७८, बिहिवार


        return view('home')
            ->with('user', $user)
            ->with('nepaliDate', $nepaliDate)
            ->with('englishDate', $englishDate);
    }

    public function postChangeLanguage(Request $request)
    {
        $validated = $request->validate([
            'lang' => 'required'
        ]);
        $language = $validated['lang'];
        App::setLocale($language);
        return redirect()->back();
    }
}
