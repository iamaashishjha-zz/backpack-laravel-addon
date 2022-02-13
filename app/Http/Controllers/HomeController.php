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
        // App::setLocale('en');
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
        $nepaliDate = toFormattedNepaliDate($date);

        // toBS(\Carbon\Carbon::now()); // 2078-4-21
        // toFormattedBSDate(\Carbon\Carbon::now()); // 21 Shrawan 2078, Thurday
        // toFormattedNepaliDate(\Carbon\Carbon::now()); // २१ साउन २०७८, बिहिवार


        return view('home')->with('user', $user)->with('date', $nepaliDate);
    }

    public function postChangeLanguage(Request $request)
    {
        // $rules = [
        //     'language' => 'in:en,fr' //list of supported languages of your application.
        // ];

        // $language = Input::get('lang'); //lang is name of form select field.

        // $lannguage = $request->lang;

        $validated = $request->validate([
            'lang' => 'required'
        ]);
        $language = $validated['lang'];
        App::setLocale($language);
        return redirect()->back();
        // dd($language);

        // if (App::isLocale('en')) {
        //     App::setLocale($language);
        //     Alert::success('language changed');
        // } else {
        //     App::setLocale('en');
        //     Alert::success('Default Language is English');
        // }
        // return redirect()->back();



        // $validator = Validator::make(compact($language), $rules);

        // if ($validator->passes()) {
        //     Session::put('language', $language);
        //     App::setLocale($language);
        // } else {/**/
        // }
    }

    public function langChange($locale)
    {
        # code...
        app()->setLocale($locale);
        session()->put(
            'locale',
            $locale
        );
        return redirect()->back();
    }
}
