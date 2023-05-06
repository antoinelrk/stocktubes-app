<?php

namespace App\Http\Requests\Tubes;

use App\Rules\GreaterThan;
use Illuminate\Foundation\Http\FormRequest;

class TubeCreateRequest extends FormRequest
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
                'max:16',
                'unique:tubes,reference'
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
                new GreaterThan($this->request->get('critical')) // TODO: Attention si critical est null !!
            ],
            'critical' => [
                'integer',
                'nullable'
            ],
            'datasheet' => [
                'file',
                'nullable'
            ]
        ];
    }
}
