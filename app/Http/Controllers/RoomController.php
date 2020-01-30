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
                ->paginate(10);
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

    public function import(Request $request){
        if($request->hasFile('template')){
            $path = $request->file('template')->getRealPath();
            $data = \Excel::load($path)->get();
           
            if($data->count() > 0){
                $rows = $data->toArray();
                foreach ($rows as $row) {
                    $inserts[]=[
                        'room_desc' => $row['room_desc'],
                        'bldg' => $row['bldg'],
                    ];
                }
            }
            $chuncked = array_chunk($inserts, 10);
            if(empty($inserts)){
                dd('Request data does not have any files to import.');  
            }
            else {
                foreach($chuncked as $inserts){
                    \DB::table('rooms')->insert($inserts);
                 }
                dd('record inserted');  
            }
        }
    }
    
}
