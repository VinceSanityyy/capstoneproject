<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();

        return response()->json($departments);
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
        $department = new Department;

        $this->validate($request, [
            'department_name' => 'required',
            'department_name' => 'required'
           ]);
        
        $department->department_code = $request->department_code;
        $department->department_name = $request->department_name;
        $department->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department, $department_id)
    {
        $departments = Department::find($request->department_id);
        $this->validate($request, [
            'department_name' => 'required',
            'department_name' => 'required'
           ]);
        $departments->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department,$department_id)
    {
        
        $department = Department::findOrFail($department_id);
        $department->delete();
    }

    public function getDepartmentsCombo(){
        $departments = \DB::table('departments')
                    ->where('deleted_at',null)
                    ->select(\DB::raw('CONCAT(department_name," - ", department_code) AS label'),
                    'department_id as id')
                    ->get();
                    
        return response()->json($departments);
    }
}
