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
            ->select('schedules.*', 'teachers.*', 'rooms.*', 'subject_codes.*', 'students.name')
            ->join('teachers', 'teachers.id', '=', 'schedules.teacher_id')
            ->join('subject_codes', 'subject_codes.id', 'schedules.subject_code_id')
            ->join('rooms', 'schedules.room_id', 'rooms.id')
            ->join('students', 'students.id', '=', 'schedules.student_id')
            ->where('schedules.deleted_at', null)
            ->latest('schedules.created_at')

            // ->limit(12);

            ->get();
        // dd($schedules);

        return response()->json($schedules);
    }

    public function schedulePagination()
    {
        $schedules = \DB::table('schedules')
            ->select('schedules.*', 'schedules.id as scid', 'teachers.*', 'rooms.*', 'subject_codes.*', 'students.name')
            ->join('teachers', 'teachers.id', '=', 'schedules.teacher_id')
            ->join('subject_codes', 'subject_codes.id', 'schedules.subject_code_id')
            ->join('rooms', 'schedules.room_id', 'rooms.id')
            ->join('students', 'students.id', '=', 'schedules.student_id')
            ->where('schedules.deleted_at', null)
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
    { }

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

        // dd($request->all());
        $days = implode(",", $request->days);
        $from = date('H:i:s', strtotime($request->start_time));
        $to = date('H:i:s', strtotime($request->end_time));

        $strDays = "";
        foreach ($request->days as $key2 => $value2) {
            if ($key2 == 0) {
                if (sizeof($request->days) == 1) {
                    $strDays = "((day LIKE '%" . $value2 . "%'))";
                } else {
                    $strDays = $strDays . "((day LIKE '%" . $value2 . "%')";
                }
            } else {
                if ($key2 == (sizeof($request->days) - 1)) {
                    $strDays = $strDays . " OR (day LIKE '%" . $value2 . "%'))";
                } else {
                    $strDays = $strDays . " OR (day LIKE '%" . $value2 . "%')";
                }
            }
        }

        
        $validate = Schedule::where('subject_code_id', $request['subject']['id'])
            ->where('teacher_id', $request['teacher']['id'])
            ->where('room_id', $request['room']['id'])
            ->where('start_time', '<', $to)
            ->where('end_time', '>', $from)
            ->where('school_year', $request->schoolyr)
            ->whereRaw($strDays)
            ->where('term', $request->term)
            ->where('semester', $request->sem)
            ->where('student_id', $request['student']['id'])
            ->exists();

        // $validate = Schedule ::where('room_id', $request->room_id)
        //     ->where('subject_code_id', $request->subject_code_id)
        //     ->where('teacher_id', $request->tid)
        //     ->where('start_time', '<', $to)
        //     ->where('end_time', '>', $from)
        //     ->where('school_year', $request->school_year)
        //     ->whereRaw($strDays)
        //     ->where('term', $request->term)
        //     ->where('semester', $request->semester)
        //     ->where('student_id', $request->student_id)
        //     ->exists();

        // dd($validate);
        if ($validate) {
            abort(404, 'Duplicate Record');
            // throw new \ErrorException('Record Exist');
        } else {
            return Schedule::create([
                'subject_code_id' => $request["subject"]['id'],
                'teacher_id' => $request["teacher"]['id'],
                'room_id' => $request["room"]['id'],
                'start_time' => $from,
                'end_time' => $to,
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
        $days = implode(",", $request->day);


        $from = date('H:i:s', strtotime($request->start_time));
        $to = date('H:i:s', strtotime($request->end_time));
        //days = Mon,Tue,Wed,Thu,Fri,Sat
        //time = eg. 12:30 PM

        $strDays = "";
        foreach ($request->day as $key2 => $value2) {
            if ($key2 == 0) {
                if (sizeof($request->day) == 1) {
                    $strDays = "((day LIKE '%" . $value2 . "%'))";
                } else {
                    $strDays = $strDays . "((day LIKE '%" . $value2 . "%')";
                }
            } else {
                if ($key2 == (sizeof($request->day) - 1)) {
                    $strDays = $strDays . " OR (day LIKE '%" . $value2 . "%'))";
                } else {
                    $strDays = $strDays . " OR (day LIKE '%" . $value2 . "%')";
                }
            }
        }

        $validate = Schedule ::where('room_id', $request->room_id)
            ->where('subject_code_id', $request->subject_code_id)
            ->where('teacher_id', $request->tid)
            ->where('start_time', '<', $to)
            ->where('end_time', '>', $from)
            ->where('school_year', $request->school_year)
            ->whereRaw($strDays)
            ->where('term', $request->term)
            ->where('semester', $request->semester)
            ->where('student_id', $request->student_id)
            ->exists();

        if ($validate) {
            abort(404, 'Duplicate Record');
        } else {

            $schedule->subject_code_id = $request->subject_code_id;
            $schedule->teacher_id = $request->tid;
            $schedule->room_id = $request->room_id;
            $schedule->start_time = $from;
            $schedule->end_time = $to;
            $schedule->school_year = $request->school_year;
            $schedule->semester = $request->semester;
            $schedule->term = $request->term;
            $schedule->day = $days;
            $schedule->student_id = $request->student_id;
            $schedule->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule, $id)
    {
        $sched_id = Schedule::findOrFail($id);
        $sched_id->delete();
    }

    public function filterSchedule(Request $request)
    {
        $schedules = \DB::table('schedules')
            ->join('teachers', 'teachers.id', '=', 'schedules.teacher_id')
            ->join('subject_codes', 'subject_codes.id', 'schedules.subject_code_id')
            ->join('rooms', 'schedules.room_id', 'rooms.id')
            ->where('schedules.deleted_at', null)
            ->where('schedules.start_time', '=', $request->start_time)
            ->where('schedules.end_time', '=', $request->end_time)
            ->latest('schedules.created_at')
            ->get();
    }

    public function getStudentScheduleCombo()
    {
        $students = \DB::table('students')
            ->select(\DB::raw('CONCAT(name," - ", idnum) AS label'), 'id as id')
            ->get();
        return response()->json($students);
    }

    public function getTeachersScheduleCombo()
    {
        $teachers = \DB::table('teachers')
            ->select(\DB::raw('CONCAT(fullname," - ", id_number) as label'), 'id as id')
            ->where('deleted_at', null)
            ->get();
        return response()->json($teachers);
    }

    public function getSubjectsScheduleCombo()
    {
        $subjects = \DB::table('subject_codes')
            ->select(\DB::raw('CONCAT(subject_code," - " ,subject_description) as label'), 'id as id')
            ->where('deleted_at', null)
            ->get();
        return response()->json($subjects);
    }

    public function getRoomsScheduleCombo()
    {
        $rooms = \DB::table('rooms')
            ->select('room_desc as label', 'id as id')
            ->where('deleted_at', null)
            ->get();
        return response()->json($rooms);
    }
}
