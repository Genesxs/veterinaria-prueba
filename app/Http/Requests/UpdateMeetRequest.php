<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMeetRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'meet_date' => 'required|date',
            'meet_time' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'meet_date.required' => 'El campo fecha de cita es requerido.',
            'meet_time.required' => 'El campo fecha de cita es requerido.'
        ];
    }
}
