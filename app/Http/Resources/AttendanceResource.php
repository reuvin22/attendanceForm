<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'date' => $this->created_at,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'gender' => $this->gender,
            'grade' => $this->grade,
            'school' => $this->school,
            'contactNumber' => $this->contactNumber
        ];
    }
}
