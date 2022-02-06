<?php

namespace App\Http\Controllers;

use App\Error;
use App\Event;
use App\EventType;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function store(Request $request)
    {
        if (!$request->events) {
            new Error($request->username, 'Custom: No events array!', $request->ip(), $request->getContent());

            abort(488, 'No events array!');
        }

        foreach ($request->events as $event) {
            try {
                $new_event = new Event();
                $new_event->username = $request->username;
                $new_event->ip_address = $request->ip();
                $new_event->link = $request->link;
                $new_event->event_type_id = EventType::where('short', $event['type'])->first()->id;
                $new_event->value = is_array($event['value']) ? json_encode($event['value']) : $event['value'];
                $new_event->save();
            } catch (\Exception $exception) {
                new Error($request->username, $exception->getMessage(), $request->ip(), $request->getContent());

                abort(489, 'Can not save events!');
            }
        }
    }
}
