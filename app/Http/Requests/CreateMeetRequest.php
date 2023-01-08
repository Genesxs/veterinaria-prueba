<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMeetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'document_owner' => 'required|int|unique:meets',
            'name' => 'required',
            'last_name' => 'required',
            'pet_name' => 'required',
            'meet_date' => 'required|date',
            'meet_time' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'document_owner.required' => 'El número de documento del dueño es requerido.',
            'name.required' => 'El campo nombre es requerido.',
            'last_name.required' => 'El campo apellido es requerido.',
            'pet_name.required' => 'El campo nombre mascota es requerido.',
            'meet_date.required' => 'El campo fecha de cita es requerido.',
            'meet_time.required' => 'El campo fecha de cita es requerido.',
            'document_owner.unique' => 'El número de documento del dueño ya esta inscrito.',
        ];
    }
}
