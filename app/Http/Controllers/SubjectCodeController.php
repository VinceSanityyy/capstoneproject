<?php

namespace App\Http\Controllers;

use App\SubjectCode;
use Illuminate\Http\Request;

class SubjectCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjectcodes = \DB::table('subject_codes')
                        ->where('deleted_at',null)
                        ->get();           
        return response()->json($subjectcodes);
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
            'subject_code' =>  ['required', 'unique:subject_codes'],
            'subject_description' => 'required',
           ]);
           return SubjectCode::create([
            'subject_code' => $request['subject_code'],
            'subject_description' => $request['subject_description'],
           ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubjectCode  $subjectCode
     * @return \Illuminate\Http\Response
     */
    public function show(SubjectCode $subjectCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubjectCode  $subjectCode
     * @return \Illuminate\Http\Response
     */
    public function edit(SubjectCode $subjectCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubjectCode  $subjectCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubjectCode $subjectCode,$id)
    {
        $subjectcode= SubjectCode::findOrFail($id);
        $this->validate($request, [
        'subject_code' => 'required',
        ]);

         $subjectcode->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubjectCode  $subjectCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubjectCode $subjectCode,$id)
    {
        $subjectcode = SubjectCode::findOrFail($id);
        $subjectcode->delete();
    }

    public function countSubjects(){

        $subjectcodes = \DB::table('subject_codes')
        ->where('deleted_at',null)
        ->count();     

        return response()->json($subjectcodes);
    }
}
