<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workstation;
use Validator;

class WorkstationController extends Controller
{
    private $days = '{"maandag":{"ochtend":{"id":0,"startsLater":0,"endsEarlier":0,"isReserved":0,"isActive":1},"middag":{"id":0,"startsLater":0,"endsEarlier":0,"isReserved":0,"isActive":1}},"dinsdag":{"ochtend":{"id":0,"startsLater":0,"endsEarlier":0,"isReserved":0,"isActive":1},"middag":{"id":0,"startsLater":0,"endsEarlier":0,"isReserved":0,"isActive":1}},"woensdag":{"ochtend":{"id":0,"startsLater":0,"endsEarlier":0,"isReserved":0,"isActive":1},"middag":{"id":0,"startsLater":0,"endsEarlier":0,"isReserved":0,"isActive":1}},"donderdag":{"ochtend":{"id":0,"startsLater":0,"endsEarlier":0,"isReserved":0,"isActive":1},"middag":{"id":0,"startsLater":0,"endsEarlier":0,"isReserved":0,"isActive":1}},"vrijdag":{"ochtend":{"id":0,"startsLater":0,"endsEarlier":0,"isReserved":0,"isActive":1},"middag":{"id":0,"startsLater":0,"endsEarlier":0,"isReserved":0,"isActive":0}}}';
    
    private $rules = [
        'number' => 'required',
        'description' => 'required',
        'system' => 'required'
    ];

    private $messages = [
        'number.required' => 'Het werkpleknummer is verplicht!',
        'description.required' => 'De omschrijving is verplicht!',
        'system.required' => 'Het systeem is verplicht!'
    ];

    public function store(Request $request)
    {
        $this->days = json_decode($this->days);
        $error = Validator::make($request->all(), $this->rules, $this->messages);
        if ($error->fails()) 
        {
            return response()->json(['errors' => $error->errors()]);
        }
        $ws = new Workstation;
        $ws->room_id = $request->input('room_id');
        $ws->number = $request->input('number');
        $ws->description = $request->input('description');
        $ws->system = $request->input('system');
        $ws->days = $this->days;
        if ($ws->save()) 
        {
            return response()->json(['success' => 'Data Added successfully.']);
        } else {
            return response()->json(['error' => 'Creating workstation failed']);
        }
    }

    public function update(Request $request)
    {
        $error = Validator::make($request->all(), $this->rules, $this->messages);
        if ($error->fails()) 
        {
            return response()->json(['errors' => $error->errors()]);
        }
        $ws = Workstation::find($request->input('id'));
        $ws->number = $request->input('number');
        $ws->description = $request->input('description');
        $ws->system = $request->input('system');
        if ($ws->save()) 
        {
            return response()->json(['success' => 'Data Added successfully.']);
        } else {
            return response()->json(['error' => 'Updating workstation failed']);
        }
    }

    public function destroy($workstation)
    {
        $ws = Workstation::find($workstation);
        if($ws->delete())
        {
            return response()->json(['success' => 'workstation deleted']);
        }
    }

    public function updateJSON(Request $request)
    {
        $fields = $request->input('fields');
        $rspns = [];
        for($i = 0; $i < count($fields); $i++)
        {
            $field = explode('-', $fields[$i]);
            $wsid = $field[2];
            $ws = Workstation::find($wsid);
            $days = $ws->days;
            $dagdeel = $field[0];
            $dag = $field[1];
            if($request->input('turnOff') == 1)
            {
                $days[$dag][$dagdeel]['id'] = 0;
                $days[$dag][$dagdeel]['isReserved'] = 0;
                $days[$dag][$dagdeel]['startsLater'] = 0;
                $days[$dag][$dagdeel]['endsEarlier'] = 0;
                $days[$dag][$dagdeel]['isActive'] = 0;
                $ws->days = $days;
                $ws->save();
            } else {
                $days[$dag][$dagdeel]['id'] = $request->input('medientId');
                $days[$dag][$dagdeel]['isReserved'] = $request->input('reserved');
                $days[$dag][$dagdeel]['startsLater'] = $request->input('startsLater');
                $days[$dag][$dagdeel]['endsEarlier'] = $request->input('endsEarlier');
                $days[$dag][$dagdeel]['isActive'] = 1;
                $ws->days = $days;
                $ws->save();
            }
        }
        return response()->json(['success' => 'gelukt']);
    }
}
