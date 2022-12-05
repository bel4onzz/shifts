<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShiftPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'date' => 'required|date',
            'employee' => 'required|string',
            'employer' => 'required|string',
            'hours' => 'required|integer',
            'rate_per_hours' => 'required|numeric',
            'shift_type' => 'required|string',
            'taxable' => 'required|string',
            'status' => 'required|string',
            'paid_at' => 'null|date',
        ];
    }
}
