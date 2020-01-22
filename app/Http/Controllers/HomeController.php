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
        $ext = \DB::table('checkers')
                ->where('remarks_id',2)
                ->join('schedules','schedules.id','=','checkers.schedule_id')
                ->join('teachers','schedules.teacher_id','=','teachers.id')
                ->where('schedules.teacher_id',1)
                ->count();

        $date = \DB::table('checkers')
                ->where('remarks_id',2)
                ->select(\DB::raw("COUNT(checkers.id) `value` "), \DB::raw("DATE_FORMAT(checkers.created_at, '%M %d, %Y') label "))
                ->join('schedules','schedules.id','=','checkers.schedule_id')
                ->join('teachers','schedules.teacher_id','=','teachers.id')
                ->where('schedules.teacher_id',1)
                ->groupBy('label')
                ->get();        
                
        return response()->json([
            'count' => $ext,
            'date' => $date
        ]);
    }
}
