<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;

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
                    ->join('departments','teachers.department_id','=','departments.id')
                    ->select('departments.department_name', 'teachers.*')
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
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'type' => 'required',
            'status' => 'required',
            'age' => 'required',
            'department_id' => 'required',
            'birthday' => 'required',
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
                'firstname' => $request['firstname'],
                'lastname' => $request['lastname'],
                'gender' => $request['gender'],
                'type' => $request['type'],
                'status' => $request['status'],
                'department_id' => $request['department_id'],
                'birthday' => $request['birthday'],
                'age' => $request['age'], 
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
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }


}
