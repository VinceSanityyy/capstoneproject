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
        return view('/home');
    }
    

    public function getGraph(Request $request,$id){
        $tid = $request->id;
        $ext = \DB::table('checkers')
                ->where('remarks_id',2)
                ->join('schedules','schedules.id','=','checkers.schedule_id')
                ->join('teachers','schedules.teacher_id','=','teachers.id')
                ->where('schedules.teacher_id',$tid)
                // ->whereBetween('checkers.created_at',  Carbon::now()->startOfWeek())
                // ->whereBetween('checkers.created_at',  Carbon::now()->endOfweek())
                // ->count();
                ->whereBetween('checkers.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();

        $date = \DB::table('checkers')
                ->where('remarks_id',2)
                ->select(\DB::raw("COUNT(checkers.id) `value` "), \DB::raw("DATE_FORMAT(checkers.created_at, '%M %d, %Y') label "))
                ->join('schedules','schedules.id','=','checkers.schedule_id')
                ->join('teachers','schedules.teacher_id','=','teachers.id')
                ->where('schedules.teacher_id',$tid)
                ->groupBy('label')
                // ->whereBetween('checkers.created_at',  Carbon::now()->startOfWeek())
                // ->whereBetween('checkers.created_at',  Carbon::now()->endOfweek())
                // ->get();        
                ->whereBetween('checkers.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
                
        return response()->json([
            'count' => $ext,
            'date' => $date
        ]);
    }


    public function generateReport(Request $request){
        $data = \DB::table('checkers')
        // ->where('remarks_id',2)
        ->join('schedules','schedules.id','=','checkers.schedule_id')
        ->join('teachers','schedules.teacher_id','=','teachers.id')
        ->join('subject_codes','subject_codes.id','=','schedules.subject_code_id')
        ->join('remarks','remarks.id','=','checkers.remarks_id')
        ->whereDate('checkers.created_at', '>=', $request->from)
        ->whereDate('checkers.created_at', '<=', $request->to)
        // ->whereBetween('checkers.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->select('teachers.fullname as Name','teachers.id_number as ID','subject_codes.subject_description as Subject','remarks.remarks_desc as Remarks',\DB::raw("DATE_FORMAT(checkers.created_at, '%d-%b-%Y') as Date"))
        ->get()->toArray(); 

        $data= json_decode( json_encode($data), true);
        
    
        return \Excel::create('reports', function($excel) use ($data) {
            $excel->sheet('reports', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->export('csv');

    }
    public function previewReport(Request $request){
        $data = \DB::table('checkers')
        // ->where('remarks_id',2)
        ->join('schedules','schedules.id','=','checkers.schedule_id')
        ->join('teachers','schedules.teacher_id','=','teachers.id')
        ->join('subject_codes','subject_codes.id','=','schedules.subject_code_id')
        ->join('remarks','remarks.id','=','checkers.remarks_id')
        ->whereDate('checkers.created_at', '>=', $request->from)
        ->whereDate('checkers.created_at', '<=', $request->to)
        ->select('teachers.fullname as Name','teachers.id_number as ID','subject_codes.subject_description as Subject','remarks.remarks_desc as Remarks',\DB::raw("DATE_FORMAT(checkers.created_at, '%d-%b-%Y') as Date"))
        ->get(); 

        // dd($data);
        return response()->json($data);
    }

    public function getStudents(){
        $students = \DB::table('students')
                    ->get();

        return response()->json($students);
    }

    public function getStudentCount(){
        $studentsCount = \DB::table('students')
                    ->where('status','=','active')
                    ->count();

        return response()->json($studentsCount);
    }

    public function updateChecker(Request $request,$id)
    {

      $checkerId = \DB::table('students')
                ->where('id','=',$request->id)
                ->get();

    //   $checkerId->status = $request->checker_status;  
    
      \DB::table('students')
            ->where('id',$request->id)
            ->update(['status' => $request->checker_status]);
    }
}
