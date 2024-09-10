<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Services\ZoomService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    protected $zoomService;

    public function __construct(ZoomService $zoomService)
    {
        $this->zoomService = $zoomService;
    }
    public function index()
    {
        $meetings = Meeting::all();

        return view('meetings.index', compact('meetings'));
    }
    public function create()
    {
        return view('meetings.create');
    }
    public function createMeeting(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'start_date_time' => 'required|date',
            'duration_in_minute' => 'required|numeric',
        ]);
        

        $meeting = $this->zoomService->createMeeting($validated);
        $meeting['start_time'] = Carbon::parse($meeting['start_time'])->format('Y-m-d H:i:s');
            // $meeting['zoom_id']=$meeting['id'];
            // Create the meeting record in the database
            Meeting::create([
                'uuid' => $meeting['uuid'],
                'id' => $meeting['id'],
                'topic' => $meeting['topic'],
                'type' => $meeting['type'],
                'start_time' => $meeting['start_time'], 
                'duration' => $meeting['duration'],
                'start_url' => $meeting['start_url'],
                'join_url' => $meeting['join_url'],
                'password' => $meeting['password'],
                'zoom_id' => $meeting['id'],
            ]);
            return redirect()->route('meetings.index')->with('success', 'Meeting created successfully!');

    }
}
