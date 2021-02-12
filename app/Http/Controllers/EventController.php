<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Exists;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index()
    {

        $myEvent= Auth::user()->events;  
        $eventShared = Auth::user()->sharedevents;
        if ($eventShared->isNotEmpty()) {
            $myEvent = $myEvent->merge($eventShared);
            $myEvent->all();
        }

        return $this->eventToArray($myEvent);

    }

    public function store(Request $request)
    {
        
        Event::create([
            'title' => $request->title,
            'start_date' => $request->start,
            'end_date' => $request->end,
            'user_id' => Auth::user()->id
        ]);
        return response()->json(['success' => 'added']);
    }
    public function update(Request $request)
    {

        $eventUser = Event::where('id', $request->id)->firstorfail();
        $roleSup = Role::where('name', 'Avocat')->orWhere('name', 'Admin')->pluck('id')->toArray();
        $eventSharedId = Auth::user()->sharedevents->pluck('id')->toArray();

        if(Auth::user()->id == $eventUser->user_id || ( in_array(Auth::user()->role_id, $roleSup) && in_array($eventUser->id, $eventSharedId)  ) ){
            $updateArr = ['start_date' => $request->start, 'end_date' => $request->end];
            $eventUser->update($updateArr);
            return response()->json(['success' => 'updated']);
        }else{
            return response()->json(['error' => 'Not Authorized']);
        }

    }


    public function delete(Request $request)
    {

        $eventUser = Event::where('id', $request->id)->firstorfail();
        $roleSup = Role::where('name', 'Admin')->firstorfail();
        $eventSharedId = Auth::user()->sharedevents->pluck('id')->toArray();

        if (Auth::user()->id == $eventUser->user_id || (Auth::user()->role_id == $roleSup->id && in_array($eventUser->id, $eventSharedId))) {
            $eventUser->delete();
            return response()->json(['success' => 'deleted']);
        } else {
            return response()->json(['error' => 'Not Authorized']);
        }

    }  

    public function eventToArray($events)
    {
        $eventArray = [];
        foreach ($events as $event) {

            $data = [
                "id" => $event->id,
                "title" => $event->title,
                "start" => $event->start_date,
                "end" => $event->end_date,
                "color" => $event->background_color,
                "textColor" => $event->text_color
            ];
        
            array_push($eventArray, $data);
        }
        return response()->json($eventArray);
    }
}
