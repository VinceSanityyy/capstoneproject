<?php

namespace App\Http\Controllers;

use App\Checker;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CheckerController extends Controller
{
   
    public function getScheduleRound(Request $request,$id){
        
        $scid = $request->id;
        $round = \DB::table('rounds')
        ->select('rounds.*','checkers.*','remarks.*','violations.*')
        ->leftJoin('checkers','checkers.id','=','rounds.checker_id')
        ->leftJoin('checker_details','rounds.id','=','checker_details.round_id')
        ->leftJoin('remarks','remarks.id','=','rounds.remarks_id')
        ->leftJoin('violations','violations.id','=','checker_details.violation_id')
        ->where('checkers.schedule_id',$scid)
        ->where('rounds.round_no','=',1)
        ->where('checkers.created_at', Carbon::today())
        ->distinct('rounds.remarks_id')
        // ->toSql();
        ->get();
        return response()->json($round);

    }

    public function getScheduleRoundTwo(Request $request,$id){
        
        $scid = $request->id;
        $round = \DB::table('rounds')
        ->select('rounds.*','checkers.*','remarks.*','violations.*')
        ->leftJoin('checkers','checkers.id','=','rounds.checker_id')
        ->leftJoin('checker_details','rounds.id','=','checker_details.round_id')
        ->leftJoin('remarks','remarks.id','=','rounds.remarks_id')
        ->leftJoin('violations','violations.id','=','checker_details.violation_id')
        ->where('checkers.schedule_id',$scid)
        ->where('rounds.round_no','=', 2)
        ->where('checkers.created_at', Carbon::today())
        ->distinct('rounds.remarks_id')
        // ->toSql();
        ->get();
  
        return response()->json($round);

    }

    public function setOverall(Request $request,$id){
      
            $checker_id = $request->cid;
            \DB::table('checkers')
            ->where('created_at', Carbon::today())
            ->where('checkers.id',$checker_id)
            ->update([
                'remarks_id'=>$request['overall'],
            ]);
    }

    public function getCheckers(){
        $overall = \DB::table('checkers')
        ->select('checkers.id as cid','schedules.*','teachers.*','rooms.*','subject_codes.*')
        ->join('schedules','schedules.id','=','checkers.schedule_id')
        ->join('teachers','teachers.id','=','schedules.teacher_id')
        ->join('subject_codes','subject_codes.id','schedules.subject_code_id')
        ->join('rooms','schedules.room_id','rooms.id')
        ->where(\DB::raw("DATE_FORMAT(checkers.created_at, '%d-%b-%Y') as created_at"), Carbon::today())
        ->get();

        return response()->json($overall);
        // dd($overall);
    }

    
}
