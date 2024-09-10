<?php

namespace App\Services;

use App\Models\Meeting;
use GuzzleHttp\Client;
use Carbon\Carbon;
use App\Services\Contracts\ZoomServiceInterface;

class ZoomService implements ZoomServiceInterface
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function createMeeting(array $data): array
    {
        $accessToken = $this->generateToken();

        $response = $this->client->post('https://api.zoom.us/v2/users/me/meetings', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'topic' => $data['title'],
                'type' => 2,
                'start_time' => Carbon::parse($data['start_date_time'])->toIso8601String(),
                'duration' => $data['duration_in_minute'],
                'settings' => [
                    'host_video' => true,
                    'participant_video' => false,
                    'waiting_room' => true,
                    'mute_upon_entry' => true,
                    'approval_type' => 0,
                    'join_before_host' => false,
                    'auto_recording' => 'local',
                ],
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
    public function deleteMeeting($meetingId)
    {
        $accessToken = $this->generateToken();

        $response = $this->client->delete("https://api.zoom.us/v2/meetings/{$meetingId}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ],
        ]);

        return $response->getStatusCode() === 204; 
    }
    public function generateToken(): string
    {
        $base64String = base64_encode(env('ZOOM_CLIENT_ID') . ':' . env('ZOOM_CLIENT_SECRET'));
        $accountId = env('ZOOM_ACCOUNT_ID');
        $response = $this->client->post('https://zoom.us/oauth/token', [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => 'Basic ' . $base64String,
            ],
            'form_params' => [
                'grant_type' => 'account_credentials',
                'account_id' => $accountId,
            ],
        ]);

        $responseBody = json_decode($response->getBody()->getContents(), true);
        return $responseBody['access_token'];
    }
}
