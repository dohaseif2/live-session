<?php

namespace App\Services\Contracts;

interface ZoomServiceInterface
{
    public function createMeeting(array $data);

    public function generateToken(): string;
    public function deleteMeeting($id);
    public function getMeetingById($id);
}

