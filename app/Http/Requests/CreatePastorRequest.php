<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Pastor;
use App\Models\PastorRole;
use App\Models\CarecellArea;
use App\Models\CarecellLeader;

class CreatePastorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['string', 'max:255'],

            'phone' => [
                'integer',
                Rule::unique((new Pastor)->getTable(), 'phone')
                    ->ignore(request()->input('id')),
            ],

            'region_id' => ['required', 'integer'],

            'roles'   => ['required', 'array'],
            'roles.*' => ['exists:' . (new PastorRole)->getTable() . ',id'],

            'area_ids'            => ['nullable', 'array'],
            'area_ids.*'          => ['exists:' . (new CarecellArea)->getTable() . ',id'],

            'second_leader_ids'   => ['nullable', 'array'],
            'second_leader_ids.*' => ['exists:' . (new CarecellLeader)->getTable() . ',id'],

            'carecell_leader_ids'   => ['nullable', 'array'],
            'carecell_leader_ids.*' => ['exists:' . (new CarecellLeader)->getTable() . ',id'],

            'profile_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'is_active'     => ['required', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'fname.required'    => 'First name is required.',
            'region_id.required'=> 'Region is required.',
            'roles.required'    => 'Please select at least one pastor role.',
            'area_ids.*.exists' => 'One or more selected carecell areas are invalid.',
            'second_leader_ids.*.exists'   => 'One or more selected second leaders are invalid.',
            'carecell_leader_ids.*.exists' => 'One or more selected carecell leaders are invalid.',
        ];
    }
}
