<?php

namespace App\Http\Requests\Tubes;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TubeUpdateRequest extends FormRequest
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
            'reference' => [
                'string',
                'nullable',
                Rule::unique('tubes')->ignore($this->reference, 'reference')
            ],
            'used' => [
                'integer',
                'nullable',
                'between:0,999'
            ],
            'unused' => [
                'integer',
                'nullable',
                'between:0,999'
            ],
            'warning' => [
                'integer',
                'nullable',
                'between:0,999'
            ],
            'critical' => [
                'integer',
                'nullable',
                'between:0,999'
            ],
            'datasheet' => [
                'file',
                'nullable'
            ]
            // TODO: Faire en sorte que le critical soit forcément en dessous du warning
        ];
    }
}
