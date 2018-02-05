<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InformationRequest extends FormRequest
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
            'company_id' => 'sometimes|required',
            'first_name' => 'sometimes|required|max:50',
            'last_name' => 'sometimes|required|max:50',
            'middle_name' => 'max:50',
            'address' => 'sometimes|required|max:250',
            'username' => 'sometimes|required|max:50|unique:users,username,' . auth()->user()->id,
            'password' => 'sometimes|required|min:6|max:50',
            'password_confirmation' => 'sometimes|required|same:password|max:50',
        ];
    }
}
