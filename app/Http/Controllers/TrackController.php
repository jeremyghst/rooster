<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Track;
use App\Models\Room;
use App\Models\Medient;
use App\Models\Workstation;
use Validator;

class TrackController extends Controller
{
    public function getAll()
    {
        return view('tracks', [
            'tracks' => Track::all()
        ]);
    }

    public function getById($track)
    {
        $rooms = Room::where('track_id', $track)->get();
        $roomnrs = [];
        foreach($rooms as $room)
        {
            array_push($roomnrs, $room->id);
        }
        $workstations = collect();
        foreach($roomnrs as $roomnr)
        {
            $wstations = Workstation::where('room_id', $roomnr)->get();
            foreach($wstations as $wstation)
            {
                $workstations->push($wstation);
            }
            
        }

        return view('track', [
            'track' => Track::find($track),
            'tracks' => Track::all(),
            'rooms' => Room::where('track_id', $track)->get(),
            'medients' => Medient::all(),
            'workstations' => $workstations
        ]); 
    }

    public function getFirst()
    {
        $track = Track::where('isActive', true)->first();
        if($track != null)
        {
            return $this->getById($track->id);    
        } else {
            return view('notrack');
        }
    }

    public function setActive(Request $request)
    {
        $tracks = $request->input('tracks');
        for($i = 0; $i < count($tracks); $i++)
        {
            $id = explode('-',$tracks[$i]['id'])[1];
            $status = $tracks[$i]['checked'];
            $track = Track::find($id);
            $track->isActive = $status;
            if(!$track->save())
            {
                return response()->json(['error' => 'Updating track failed']);
            }
        }
        return response()->json(['success' => 'Updating successful']);
    }

    public function store(Request $request)
    {
        $rules = ['trackName' => 'required'];
        $messages = ['trackName.required' => 'De tracknaam is verplicht!'];
        $error = Validator::make($request->all(), $rules, $messages);
        if ($error->fails()) 
        {
            return response()->json(['errors' => $error->errors()]);
        }
        $track = new Track;
        $track->name = $request->input('trackName');
        $track->isActive = true;
        if ($track->save()) 
        {
            return response()->json(['success' => 'Data added successfully.']);
        } else {
            return response()->json(['error' => 'Creating track failed']);
        }

    }
}
