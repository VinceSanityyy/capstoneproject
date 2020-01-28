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


}
