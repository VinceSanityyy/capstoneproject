<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Exports\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;

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
    

    public function getGraph(Request $request,$id){
        $tid = $request->id;
        $ext = \DB::table('checkers')
                ->where('remarks_id',2)
                ->join('schedules','schedules.id','=','checkers.schedule_id')
                ->join('teachers','schedules.teacher_id','=','teachers.id')
                ->where('schedules.teacher_id',$tid)
                ->count();

        $date = \DB::table('checkers')
                ->where('remarks_id',2)
                ->select(\DB::raw("COUNT(checkers.id) `value` "), \DB::raw("DATE_FORMAT(checkers.created_at, '%M %d, %Y') label "))
                ->join('schedules','schedules.id','=','checkers.schedule_id')
                ->join('teachers','schedules.teacher_id','=','teachers.id')
                ->where('schedules.teacher_id',$tid)
                ->groupBy('label')
                ->where('checkers.created_at', '>', Carbon::now()->startOfWeek())
                ->where('checkers.created_at', '<', Carbon::now()->endOfweek())
                ->get();        
                
        return response()->json([
            'count' => $ext,
            'date' => $date
        ]);
    }


    public function generateReport(){
        
        return Excel::download(new AttendanceExport, 'users.xlsx');

        // $ext = \DB::table('checkers')
        // ->join('schedules','schedules.id','=','checkers.schedule_id')
        // ->join('teachers','schedules.teacher_id','=','teachers.id')
        // ->count();

        // $date = \DB::table('checkers')
        // // ->where('remarks_id',2)
        // ->select(\DB::raw("COUNT(checkers.id) `value` "), \DB::raw("DATE_FORMAT(checkers.created_at, '%M %d, %Y') date "))
        // ->join('schedules','schedules.id','=','checkers.schedule_id')
        // ->join('teachers','schedules.teacher_id','=','teachers.id')
        // ->join('subject_codes','subject_codes.id','=','schedules.subject_code_id')
        // ->join('remarks','remarks.id','=','checkers.remarks_id')
        // ->groupBy('date')
        // ->where('checkers.created_at', '>', Carbon::now()->startOfWeek())
        // ->where('checkers.created_at', '<', Carbon::now()->endOfweek())
        // // ->select('teachers.fullname','subject_codes.subject_description','remarks.remarks_desc','checkers.created_at') 
        // ->get(); 

        //  dd($date);

        // return response()->json([
        //     'count' => $ext,
        //     'date' => $date
        // ]);
        
    
    }
}
