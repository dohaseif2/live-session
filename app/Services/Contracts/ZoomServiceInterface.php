<?php

namespace App\Services\Contracts;

interface ZoomServiceInterface
{
    public function createMeeting(array $data): array;

    public function generateToken(): string;
    public function deleteMeeting($id);

}

