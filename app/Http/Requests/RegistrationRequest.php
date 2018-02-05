<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'middle_name' => 'max:191',
            'email' => 'required|email|max:191|unique:users',
            'username' => 'required|max:191|unique:users',
            'contact' => 'required|max:191',
        ];
    }
}
