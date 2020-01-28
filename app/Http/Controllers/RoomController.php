<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use DB;
class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room = DB::table('rooms')
                ->where('rooms.deleted_at',null)
                ->get();
        // dd($rooms);
        return response()->json($room);
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
      'room_desc' =>  ['required', 'unique:rooms'],
      'bldg' => 'required',

     ]);
     return Room::create([
      'room_desc' => $request['room_desc'],
      'bldg' => $request['bldg'],

     ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room ,$id)
    {
      $room= Room::findOrFail($id);
      $this->validate($request, [
         'room_desc' => 'required',
         'bldg' => 'required'
        ]);

      $room->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room,$id)
    {
        $room = Room::findOrFail($id);
        $room->delete();
    }
}
