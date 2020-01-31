<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;
use Carbon\Carbon;
class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = \DB::table('teachers')
                    ->where('teachers.deleted_at','=',null)
                    ->get();
        return response()->json($teachers);
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
        $this->validate($request,[
            'fullname' => 'required',
            'image' => 'required',
            'course' => 'required',
            'contact' => 'required',
       
        ]);

        if($request->image){
            $name = time().'.'. explode('/', explode(':', substr($request->image, 0, strpos
             ($request->image, ';'))) [1])[1];
             \Image::make($request->image)->save(public_path('img/').$name);

            //  $request->merge(['image' => $name]);
             $userPhoto = public_path('img/profile/');
             if(file_exists($userPhoto)){
                @unlink($userPhoto);
             }
             return Teacher::create([
                'fullname' => $request['fullname'],
                'course' => $request['course'],
                'contact' => $request['contact'],
                'image' => $name,
            ]);
        };

      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher,$id)
    {

        $teacher = Teacher::findOrFail($id);

       
        $this->validate($request,[
            'fullname' => 'required',
            // 'image' => 'required',
            'course' => 'required',
        ]);

        if($request->image){
            $name = time().'.'. explode('/', explode(':', substr($request->image, 0, strpos
             ($request->image, ';'))) [1])[1];
             \Image::make($request->image)->save(public_path('img/').$name);
             $userPhoto = public_path('img/profile/');
             if(file_exists($userPhoto)){
                @unlink($userPhoto);
             }
        };
        $teacher->fullname = $request->fullname;
        $teacher->course = $request->course;
        $teacher->contact = $request->contact;
        $teacher->image = $name;
        $teacher->save($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $teacher->delete();

        return ['message' => 'Record Deleted'];
    }

    public function countTeachers(){
        
        $teachers = \DB::table('teachers')
                    ->where('teachers.deleted_at','=',null)
                    ->count();
        return response()->json($teachers);
    }

    public function getTeacherPersonal(Request $request){

        $teachers_name = \Auth::user()->name;
        $teacher_id = \DB::table('teachers')
                        ->select('teachers.id')
                        ->where('teachers.fullname','like','%'.$teachers_name.'%')
                        ->first();
        

       

        $date = \DB::table('checkers')
            // ->where('remarks_id',2)
            ->join('schedules','schedules.id','=','checkers.schedule_id')
            ->join('teachers','schedules.teacher_id','=','teachers.id')
            ->join('subject_codes','subject_codes.id','=','schedules.subject_code_id')
            ->join('remarks','remarks.id','=','checkers.remarks_id')
            ->where('schedules.teacher_id',$teacher_id->id)
            ->whereDate('checkers.created_at', '>=', $request->from)
            ->whereDate('checkers.created_at', '<=', $request->to)
            ->select('teachers.fullname','subject_codes.subject_description','remarks.remarks_desc',\DB::raw("DATE_FORMAT(checkers.created_at, '%d-%b-%Y') as created_at"))
            ->get(); 

      return response()->json($date);
    }


}

 // $date = \DB::table('checkers')
        // ->where('remarks_id',2)
        // ->select(\DB::raw("COUNT(checkers.id) `value` "), \DB::raw("DATE_FORMAT(checkers.created_at, '%M %d, %Y') label "))
        // ->join('schedules','schedules.id','=','checkers.schedule_id')
        // ->join('teachers','schedules.teacher_id','=','teachers.id')
        // ->where('schedules.teacher_id',$teacher_id)
        // // ->whereBetween('checkers.created_at',  Carbon::now()->startOfWeek())
        // // ->whereBetween('checkers.created_at',  Carbon::now()->endOfweek())
        // // ->get();        
        // ->whereBetween('checkers.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        // ->get();