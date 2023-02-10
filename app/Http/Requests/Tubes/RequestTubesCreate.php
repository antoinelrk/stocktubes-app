<?php

namespace App\Http\Requests\Tubes;

use App\Rules\GreaterThan;
use Illuminate\Foundation\Http\FormRequest;

class RequestTubesCreate extends FormRequest
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
                'nullable'
            ],
            'used' => [
                'integer',
                'nullable'
            ],
            'unused' => [
                'integer',
                'nullable'
            ],
            'warning' => [
                'integer',
                'nullable',
                new GreaterThan($this->request->get('critical'))
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
