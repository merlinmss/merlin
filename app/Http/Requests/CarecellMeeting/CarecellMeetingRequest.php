<?php

namespace App\Http\Requests\CarecellMeeting;

use Illuminate\Foundation\Http\FormRequest;

class CarecellMeetingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pastor_id' => ['required', 'exists:pastors,id'],
            'sectional_leader_id' => ['required', 'exists:carecell_leaders,id'],
            'carecell_leader_id' => ['required', 'exists:carecell_leaders,id'],
            'area_id' => ['required', 'exists:carecell_areas,id'],

            'meeting_date' => ['required', 'date'],
            'start_time' => ['required'],
            'end_time' => ['required'],

            'members_count' => ['required', 'integer', 'min:0'],
            'new_members_count' => ['required', 'integer', 'min:0'],

            'offering_amount' => ['nullable', 'numeric'],
        ];
    }
}
