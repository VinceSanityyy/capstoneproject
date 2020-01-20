<?php

namespace App\Http\Controllers;

use App\Checker;
use Illuminate\Http\Request;

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
        ->join('checkers','checkers.id','=','rounds.checker_id')
        ->join('checker_details','rounds.id','=','checker_details.round_id')
        ->join('remarks','remarks.id','=','rounds.remarks_id')
        ->join('violations','violations.id','=','checker_details.violation_id')
        ->where('checkers.schedule_id',$scid)
        ->where('rounds.round_no','=',1)
        ->distinct('rounds.remarks_id')
        // ->toSql();
        ->get();
        return response()->json($round);

    }

    public function getScheduleRoundTwo(Request $request,$id){
        
        $scid = $request->id;
        $round = \DB::table('rounds')
        ->select('rounds.*','checkers.*','remarks.*','violations.*')
        ->join('checkers','checkers.id','=','rounds.checker_id')
        ->join('checker_details','rounds.id','=','checker_details.round_id')
        ->join('remarks','remarks.id','=','rounds.remarks_id')
        ->join('violations','violations.id','=','checker_details.violation_id')
        ->where('checkers.schedule_id',$scid)
        ->distinct('rounds.remarks_id')
        ->where('rounds.round_no','=', 2)
        ->get();
  
        return response()->json($round);

    }
}
