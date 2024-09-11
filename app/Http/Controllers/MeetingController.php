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

        $this->zoomService->createMeeting($validated);

        return redirect()->route('meetings.index')->with('success', 'Meeting created successfully!');
    }

    public function destroy($id)
    {
        $meeting = Meeting::findOrFail($id);
        $zoomDeleted = $this->zoomService->deleteMeeting($meeting->zoom_id);
        if ($zoomDeleted) {
            $meeting->delete();
            return redirect()->route('meetings.index')->with('success', 'Meeting deleted successfully.');
        } else {
            return redirect()->route('meetings.index')->with('error', 'Failed to delete meeting from Zoom.');
        }
    }
    public function viewMeeting($id)
    {
        $meeting = $this->zoomService->getMeetingById($id);
        return view('meetings.hostlink', ['meeting' => $meeting]);
    }

    public function viewGestMeeting($id)
    {
        $meeting = $this->zoomService->getMeetingById($id);
        return view('meetings.gestlink', ['meeting' => $meeting]);
    }
}
