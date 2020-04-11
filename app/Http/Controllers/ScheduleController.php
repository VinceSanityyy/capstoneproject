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
        ->select('schedules.*','teachers.*','rooms.*','subject_codes.*','students.name')
        ->join('teachers','teachers.id','=','schedules.teacher_id')
        ->join('subject_codes','subject_codes.id','schedules.subject_code_id')
        ->join('rooms','schedules.room_id','rooms.id')
        ->join('students','students.id','=','schedules.student_id')
        ->where('schedules.deleted_at',null)
        ->latest('schedules.created_at')
        
        // ->limit(12);
        
        ->get();
        // dd($schedules);

        return response()->json($schedules);
    }

    public function schedulePagination(){
        $schedules = \DB::table('schedules')
        ->select('schedules.*','schedules.id as scid','teachers.*','rooms.*','subject_codes.*','students.name')
        ->join('teachers','teachers.id','=','schedules.teacher_id')
        ->join('subject_codes','subject_codes.id','schedules.subject_code_id')
        ->join('rooms','schedules.room_id','rooms.id')
        ->join('students','students.id','=','schedules.student_id')
        ->where('schedules.deleted_at',null)
        ->latest('schedules.created_at')
        ->paginate(6);

        return response()->json($schedules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'start_time' => 'required',
            'end_time' => 'required',
            'schoolyr' => 'required',
            'sem' => 'required',
            'term' => 'required',
            'days' => 'required',
            'student' => 'required',
            'subject' => 'required',
            'room' => 'required',
            'teacher' => 'required'
           ]);

        //    dd($request['days']);
        //    $arr = json_encode($request->days);
        //    $arr = str_replace(['"', '[', ']'], [''], $arr);
        //    $arr = str_replace(',','-',$arr);
           $days = implode(",", $request->days);
           $validate = Schedule::where('subject_code_id',$request->subject)
           ->where('teacher_id',$request['teacher']['id'])
           ->where('room_id',$request['room']['id'])
           ->where('start_time',$request->start_time)
           ->where('end_time',$request->end_time)
        //    ->where('end_time',$request->end_time)
           ->where('school_year',$request->schoolyr)
           ->where('day',$request->days)
           ->where('term',$request->term)
           ->where('semester',$request->sem)
           ->count();

           if($validate >= 1){
            throw new \ErrorException('Record Exist');
            } else{
                return Schedule::create([
                    'subject_code_id' => $request["subject"]['id'],
                    'teacher_id' => $request["teacher"]['id'],
                    'room_id' =>$request["room"]['id'],
                    'start_time' => $request["start_time"],
                    'end_time' => $request["end_time"],
                    'school_year' => $request["schoolyr"],
                    'semester' => $request["sem"],
                    'term' => $request["term"],
                    'day' => $days,
                    'student_id' => $request["student"]['id'],
                   ]);
            }
        
          
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
    public function update(Request $request, Schedule $schedule, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $validate = Schedule::where('subject_code_id',$request->subject_code_id)
                        ->where('teacher_id',$request->teacher_id)
                        ->where('room_id',$request->room_id)
                        ->where('start_time',$request->start_time)
                        ->where('end_time',$request->end_time)
                        // ->whereBetween('start_time',[$request->start_time, $request->end_time])
                        // ->whereBetween('end_time',[$request->start_time, $request->end_time])
                        ->where('school_year',$request->school_year)
                        ->where('day',$request->day)
                        ->where('term',$request->term)
                        ->where('semester',$request->semester)
                        ->count();
        dd($request->all());
        // dd($validate);
        if($validate >= 1){
                throw new \ErrorException('Record Exist');
              dd('exist');
        } else{
                $schedule->update($request->all());
        }

        
        // $schedule->subject_code_id = $request->subject;
        // $schedule->teacher_id = $request->teacher;
        // $schedule->room_id = $request->room;
        // $schedule->start_time = $request->start_time;
        // $schedule->end_time = $request->end_time;
        // $schedule->school_year = $request->schoolyr;
        // $schedule->semester = $request->sem;
        // $schedule->term = $request->term;
        // $schedule->day = $request->days;
        // $schedule->update($request->all());
        
  


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule,$id)
    {
        $sched_id = Schedule::findOrFail($id);
        $sched_id->delete();
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

    public function getStudentScheduleCombo(){
        $students = \DB::table('students')
                ->select(\DB::raw('CONCAT(name," - ", idnum) AS label'),'id as id')
                ->get();
        return response()->json($students);
    }

    public function getTeachersScheduleCombo(){
        $teachers = \DB::table('teachers')
                    ->select(\DB::raw('CONCAT(fullname," - ", id_number) as label'),'id as id')
                    ->where('deleted_at',null)
                    ->get();
        return response()->json($teachers);
    }

    public function getSubjectsScheduleCombo(){
        $subjects = \DB::table('subject_codes')
                    ->select(\DB::raw('CONCAT(subject_code," - " ,subject_description) as label'),'id as id')
                    ->where('deleted_at',null)
                    ->get();
        return response()->json($subjects);
    }

    public function getRoomsScheduleCombo(){
        $rooms = \DB::table('rooms')
                    ->select('room_desc as label','id as id')
                    ->where('deleted_at',null)
                    ->get();
        return response()->json($rooms);
    }
 
}
