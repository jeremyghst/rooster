<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Track;
use Validator;

class RoomController extends Controller
{
    private $rules = [
        'number' => 'required',
        'name' => 'required',
        'abbreviation' => 'required',
        'track_id' => 'required',
    ];

    private $messages = [
        'number.required' => 'Het lokaalnummer is verplicht!',
        'name.required' => 'De lokaalnaam is verplicht!',
        'abbreviation.required' => 'De afkorting is verplicht!',
        'track_id.required' => 'Selecteer een traject.'
    ];
    
    public function getAll()
    {
        return view('rooms', [
            'rooms' => Room::all(),
            'tracks' => Track::all()
        ]);
    }
    
    public function getById($room)
    {
        return view('room', [
            'room' => Room::find($room),
            'tracks' => Track::all()
        ]); 
    }

    public function store(Request $request)
    {
        //valideer de data
        $error = Validator::make($request->all(), $this->rules, $this->messages);
        //als validatie faalt, stuur errors
        if ($error->fails()) 
        {
            return response()->json(['errors' => $error->errors()]);
        }
        //validatie is gelukt, sla op
        $room = new Room;
        $room->number = $request->input('number');
        $room->name = $request->input('name');
        $room->abbreviation = $request->input('abbreviation');
        $room->track_id = $request->input('track_id');
        if ($room->save()) 
        {
            return response()->json(['success' => 'Data Added successfully.']);
        } else {
            return response()->json(['error' => 'Creating room failed']);
        }
    }

    public function update(Request $request)
    {
        //valideer de data
        $error = Validator::make($request->all(), $this->rules, $this->messages);
        //als validatie faalt, stuur errors
        if ($error->fails()) 
        {
            return response()->json(['errors' => $error->errors()]);
        }

        $room = Room::find($request->input('id'));
        $room->number = $request->input('number');
        $room->name = $request->input('name');
        $room->abbreviation = $request->input('abbreviation');
        $room->track_id = $request->input('track_id');
        if ($room->save()) 
        {
            return response()->json(['success' => 'Data Added successfully.']);
        } else {
            return response()->json(['error' => 'Updating room failed']);
        }
    }

    public function destroy($room)
    {
        $room = Room::find($room);
        $room->workstations()->delete();
        if($room->delete())
        {
            return response()->json(['success' => 'room deleted']);
        }
    }
}
