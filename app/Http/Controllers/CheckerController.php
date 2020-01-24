<?php

namespace App\Http\Controllers;

use App\Checker;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CheckerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Checker  $checker
     * @return \Illuminate\Http\Response
     */
    public function show(Checker $checker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Checker  $checker
     * @return \Illuminate\Http\Response
     */
    public function edit(Checker $checker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Checker  $checker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checker $checker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Checker  $checker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checker $checker)
    {
        //
    }

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
        // ->where('rounds.created_at', Carbon::today())
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
        ->where('checkers.created_at', Carbon::today())
        // ->where('rounds.created_at', Carbon::today())
        ->distinct('rounds.remarks_id')
        ->where('rounds.round_no','=', 2)
        // ->toSql();
        ->get();
  
        return response()->json($round);

    }

    public function setOverall(Request $request,$id){
        // \DB::table('checkers')
        //     ->where('schedule_id', $scid)
        //     ->where('created_at',Carbon::today())
        //     ->limit(1)
        //     ->update(array('remarks_id', '=', $request->overall));

            Checker::find($id)
            ->where('created_at', Carbon::today())
            ->update([
                'remarks_id'=>$request['overall'],
            ]);

        // dd($scid);
        
    }
}
