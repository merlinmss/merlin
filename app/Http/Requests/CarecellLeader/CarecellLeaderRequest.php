<?php

namespace App\Http\Requests\CarecellLeader;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\CarecellLeader;

class CarecellLeaderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->input('id', 0);

        return [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'phone' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique((new CarecellLeader)->getTable(), 'phone')
                    ->ignore($id),
            ],
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique((new CarecellLeader)->getTable(), 'email')
                    ->ignore($id),
            ],
            'leader_role' => ['required', 'integer', Rule::in([1, 2, 3])],
            'is_active'   => ['required', 'integer', Rule::in([0, 1])],
        ];
    }

    public function messages(): array
    {
        return [
            'fname.required'       => 'First name is required.',
            'lname.required'       => 'Last name is required.',
            'phone.unique'         => 'This phone number is already in use.',
            'email.unique'         => 'This email address is already in use.',
            'email.email'          => 'Please enter a valid email address.',
            'leader_role.required' => 'Please select a leader role.',
            'leader_role.in'       => 'Invalid leader role selected.',
            'is_active.required'   => 'Please select a status.',
        ];
    }
}
