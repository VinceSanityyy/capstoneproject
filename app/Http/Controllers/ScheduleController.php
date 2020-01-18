<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = \DB::table('schedules')
        ->select('schedules.*','teachers.*','rooms.*','subject_codes.*')
        ->join('teachers','teachers.id','=','schedules.teacher_id')
        ->join('subject_codes','subject_codes.id','schedules.subject_code_id')
        ->join('rooms','schedules.room_id','rooms.id')
        ->where('schedules.deleted_at',null)
        ->latest('schedules.created_at')
        
        // ->limit(12);
        
        ->get();
        // dd($schedules);

        return response()->json($schedules);
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
        $this->validate($request, [
            // 'subject_code_id' => 'required',
            // 'teacher_id' => 'required',
            // 'room_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'schoolyr' => 'required',
            'sem' => 'required',
            'term' => 'required',
            'days' => 'required',
      
           ]);
        
           return Schedule::create([
            'subject_code_id' => $request["subject"],
            'teacher_id' => $request["teacher"],
            'room_id' =>$request["room"],
            'start_time' => $request["start_time"],
            'end_time' => $request["end_time"],
            'school_year' => $request["schoolyr"],
            'semester' => $request["sem"],
            'term' => $request["term"],
            'day' => $request["days"],
           ]);

        // $schedules = \DB::table('schedules')->insert([
        //     ['subject_code_id' => $request->subject],
        //     ['teacher_id' => $request->teacher],
        //     ['room_id' =>$request->room],
        //     ['start_time' => $request->start_time],
        //     ['end_time' => $request->end_time],
        //     ['school_year' => $request->schoolyr],
        //     ['semester' => $request->sem],
        //     ['term' => $request->term],
        //     ['day' => $request->days],
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }

    public function filterSchedule(Request $request){
        $schedules = \DB::table('schedules')
        ->join('teachers','teachers.id','=','schedules.teacher_id')
        ->join('subject_codes','subject_codes.id','schedules.subject_code_id')
        ->join('rooms','schedules.room_id','rooms.id')
        ->where('schedules.deleted_at',null)
        ->where('schedules.start_time','=',$request->start_time)
        ->where('schedules.end_time','=',$request->end_time)
        ->latest('schedules.created_at')
        ->get();
    }

 
}
