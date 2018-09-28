<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
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
            'starts_at'               => 'required|date|after:now',
            'ends_at'                 => 'required|date|after:starts_at',
            'appointment_title'       => 'required|max:255',
            'appointment_description' => 'required|max:255',
            'related_github_issue'    => 'max:255',
            'location'                => 'required|max:255',
            'appointment_to_user'     => 'required|email|max:255'
        ];
    }
}
