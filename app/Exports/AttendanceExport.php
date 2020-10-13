<?php

namespace App\Exports;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
class AttendanceExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $date = \DB::table('checkers')
                ->where('remarks_id',2)
                // ->select(\DB::raw("COUNT(checkers.id) `value` "), \DB::raw("DATE_FORMAT(checkers.created_at, '%M %d, %Y') label "))
                ->join('schedules','schedules.id','=','checkers.schedule_id')
                ->join('teachers','schedules.teacher_id','=','teachers.id')
                ->join('subject_codes','subject_codes.id','=','schedules.subject_code_id')
                ->join('remarks','remarks.id','=','checkers.remarks_id')
                // ->where('checkers.created_at', '>', Carbon::now()->startOfWeek())
                // ->where('checkers.created_at', '<', Carbon::now()->endOfweek())
                ->whereBetween('checkers.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->select('teachers.fullname','subject_codes.subject_description','remarks.remarks_desc','checkers.created_at')
                ->get(); 

        return $date;
    }
}
