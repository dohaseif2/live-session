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

            return response()->json(['Meeting' => $meeting], 201);
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
