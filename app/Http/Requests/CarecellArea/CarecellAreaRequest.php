<?php

namespace App\Http\Requests\CarecellArea;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\CarecellArea;

class CarecellAreaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->input('id', 0);

        return [
            'area_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique((new CarecellArea)->getTable(), 'area_name')
                    ->ignore($id),
            ],
            'area_description' => ['nullable', 'string', 'max:500'],
            'is_active'        => ['required', 'integer', Rule::in([0, 1])],
        ];
    }

    public function messages(): array
    {
        return [
            'area_name.required' => 'Area name is required.',
            'area_name.unique'   => 'This area name already exists.',
            'is_active.required' => 'Please select a status.',
        ];
    }
}
