<?php

namespace App\Http\Controllers\User;

use App\Models\Room;
use Inertia\Inertia;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\NewChatMessageEvent;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //returns all the chatrooms//
    public function index() {
        return Inertia::render('User/ChatRooms/Index', [      //returning views in resources/pages
            'rooms' => Room::get()                              //returning views in .index page with different chatrooms
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //creates the chatrooms//
    public function create()
    {
        return Inertia::render(
            'User/ChatRooms/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room $room
     * @return \Illuminate\Http\Response
     */
    //after creating the chatroon it will store the chatroom details//
    public function store(Request $request, Room $room) {
        $message = $room->messages()->create([
            'body' => $request->body,
            'user_id' => auth()->id()
        ]);
        broadcast(new NewChatMessageEvent($message, auth()->user()))->toOthers();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    //passing the room and the messages inside the chatrooms//
    public function show(Room $room) {
        $messages = Message::where('room_id', $room->id)
            ->with('user')
            ->oldest()
            ->get();          //getting messages from the database
        return Inertia::render('User/ChatRooms/Show', [
            'room' => $room,
            'messages' => $messages,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
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
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    //show the active members in the chatroom
    public function update(Request $request, Room $room) {

        $model = Room::findOrFail($room->id);
        $model->active += 1;
        $model->save();
        
        $messages = Message::where('room_id', $room->id)
            ->with('user')
            ->oldest()
            ->get();

        return Inertia::render('User/ChatRooms/Show', [
            'room' => $room,
            'messages' => $messages,
        ]);
    }

    //if you leave the chatroom it will update the active members
    public function roomLogout(Request $request, Room $room) {
        
        $model = Room::findOrFail($room->id);
        $model->active -= 1;
        $model->save();

        return Inertia::render('User/ChatRooms/Index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        //
    }
//show the room that's created//
    public function newroom(Request $request, Room $room) {
        Room::create([
            'name' => $request->name,
            'slug' => \Str::slug($request->slug),
        ]);
        sleep(1);

        return redirect()->route('chat-rooms.index')->with('message', 'Chat Room Created Successfully');
    }
}