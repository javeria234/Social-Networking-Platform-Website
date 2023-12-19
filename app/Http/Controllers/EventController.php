<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventAttendees;

use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //show all the upcoming events//
    public function index(Request $request)
    {
        $events = Event::all();

        return Inertia::render(
            'User/Events/Index',      ///showing all availble events
            [
                'events' => $events
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //direct us to create the events page//
    public function create()
    {
        return Inertia::render(
            'User/Events/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //creates the events//
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|string|max:255',
            'description' => 'required',
            'date_of_event' => 'required',
            'time_start' => 'required',
            'time_end' => 'required',
            'venue' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $image_path = '';
        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('image', 'public');
        }
        $user = auth()->user()->id;

        Event::create([
            'title' => $request->title,
            'slug' => \Str::slug($request->slug),
            'description' => $request->description,
            'date_of_event' => $request->date_of_event,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
            'venue' => $request->venue,
            'image' => $image_path,
            'user_id' => $user
        ]);
        sleep(1);

        return redirect()->route('events.index')->with('message', 'Event Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    //shows the details of one event/eventattendees//
    public function show(Event $event)
    {
        $eventId = $event->id;  

        $eventAttendees = EventAttendees::where('event_id', '=', $eventId)->count();

        return Inertia::render(
            'User/Events/Show',
            
            [
                'event' => $event,
                'eventAttendees' => $eventAttendees,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    //editing the event details//
    public function edit(Event $event)
    {
        return Inertia::render(
            'User/Events/Edit',
            [
                'event' => $event
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    //after editing the event it will update the event details//
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|string|max:255',
            'description' => 'required',
            'date_of_event' => 'required',
            'time_start' => 'required',
            'time_end' => 'required',
            'venue' => 'required',
        ]);

        $event->title = $request->title;
        $event->slug = \Str::slug($request->slug);
        $event->description = $request->description;
        $event->date_of_event = $request->date_of_event;
        $event->time_start = $request->time_start;
        $event->time_end = $request->time_end;
        $event->venue = $request->venue;
        $event->save();
        sleep(1);

        return redirect()->route('events.index')->with('message', 'Event Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    //
    public function destroy(Event $event)
    {
        $event->delete();
        sleep(1);

        return redirect()->route('events.index')->with('message', 'Event Delete Successfully');
    }

//reserving a  ticket function is called ///
    public function eventAttendees(Request $request, Event $event)
    {
        $event = new EventAttendees();
        $event->title = $request->title;
        $event->event_id = $request->id;
        $event->user_id = auth()->user()->id;    //we are passing the id of the authorise user for the event attendees
        $event->save();

        return redirect()->route('events.index')->with('message', 'Event Booked Successfully');
    }
//reserving/display the ticket for event/
    public function tickets(Request $request)
    {
        $user = auth()->user()->id;

        $eventAttendees = EventAttendees::where('user_id', '=', $user)->get();

        return Inertia::render(
            'User/Events/MyTickets',
            [
                'eventAttendees' => $eventAttendees,
            ]
        );
    }

    

}
