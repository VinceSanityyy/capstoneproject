<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('home');
    }
    

    public function getGraph(){
        $ext = \DB::table('checkers')->distinct()->get();
        $grouped = $ext->groupBy('schedule_id')->map(function($item, $key) {
            return ['count' => collect($item)->count()];
        });

        return response()->json($grouped);
    }
}
