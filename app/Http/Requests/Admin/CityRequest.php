<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'state_id' => 'required|exists:states,id',
            'name'     => 'required|string|max:100',
            'status'   => 'required|boolean',
        ];
    }
}