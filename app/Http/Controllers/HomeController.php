<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Pratiksh\Nepalidate\Facades\NepaliDate;

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
        $nepaliDate = toFormattedNepaliDate($date);

        // toBS(\Carbon\Carbon::now()); // 2078-4-21
        // toFormattedBSDate(\Carbon\Carbon::now()); // 21 Shrawan 2078, Thurday
        // toFormattedNepaliDate(\Carbon\Carbon::now()); // २१ साउन २०७८, बिहिवार

        // dd($nepaliDate);
        return view('home')->with('user', $user)->with('date', $nepaliDate);
    }
}
