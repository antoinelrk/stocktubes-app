<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RequestRegister extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:users,name'
            ],
            'password' => [
                'string',
                'required',
                'confirmed',
                'min:8'
            ],
            'password_confirmation' => [
                'string',
                'required',
                'min:8'
            ]
        ];
    }
}
