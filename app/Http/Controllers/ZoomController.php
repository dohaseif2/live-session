<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Services\Contracts\ZoomServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ZoomController extends Controller
{
    protected $zoomService;

    public function __construct(ZoomServiceInterface $zoomService)
    {
        $this->zoomService = $zoomService;
    }

    public function createMeeting(Request $request)
    {
        $validated = $this->validate($request, [
            'title' => 'required',
            'start_date_time' => 'required|date',
            'duration_in_minute' => 'required|numeric',
        ]);

        try {
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
            return response()->json(["Meeting" => $meeting], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function deleteMeeting($id)
    {
        try {
            $meeting = Meeting::where('zoom_id', $id)->firstOrFail();

            $this->zoomService->deleteMeeting($id);

            $meeting->delete();

            return response()->json(['success' => 'Meeting deleted successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
