<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class profileRequest extends Request
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
            'name' => 'required|max: 255',
            'SIRET' => 'required|max: 14',
            'adresse' => 'required|array',
            'adresse.*.cp' => 'required|max:5',
            'adresse.*.ville' => 'required|max:255',
            'adresse.*.rue' => 'required|max:255',
            'adresse.*.comp' => 'max:255',
        ];
    }
}
