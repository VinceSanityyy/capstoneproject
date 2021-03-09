<?php

namespace App\Http\Controllers;

use App\Comments;
use Illuminate\Http\Request;
use Auth;
class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = \DB::table('comments')
                    ->join('users','users.id','comments.user_id')
                    ->join('checkers','checkers.id','comments.checker_id')
                    ->join('schedules','schedules.id','=','checkers.schedule_id')
                    ->join('rooms','schedules.room_id','=','rooms.id')
                    ->join('remarks','remarks.id','=','checkers.remarks_id')
                    ->join('subject_codes','subject_codes.id','=','schedules.subject_code_id')
                    ->select(\DB::raw("DATE_FORMAT(comments.created_at, '%d-%b-%Y') as r"),'rooms.*','schedules.*','users.*','comments.*','subject_codes.*')
                    ->get();
        return response()->json($comments);
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
        $currentuserid = Auth::user()->id;
        $this->validate($request, [
            'comment' => 'required',
      
           ]);
           if($request->picture){
            $name = time().'.'. explode('/', explode(':', substr($request->picture, 0, strpos
             ($request->picture, ';'))) [1])[1];
             \Image::make($request->picture)->save(public_path('img/').$name);

            //  $request->merge(['image' => $name]);
             $userPhoto = public_path('img/profile/');
             if(file_exists($userPhoto)){
                @unlink($userPhoto);
             }
             return Comments::create([
                'comment' => $request['comment'],
                'user_id' => $currentuserid,
                'checker_id' => $request->checker_id,
                'picture' => $name,
            ]);
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function show(Comments $comments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function edit(Comments $comments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comments $comments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comments $comments)
    {
        //
    }
}
