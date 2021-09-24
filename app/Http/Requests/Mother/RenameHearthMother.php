<?php

namespace App\Http\Requests\Mother;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int hearth_id
 * @property string name
 */
class RenameHearthMother extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'hearth_id' => 'required|integer',
            'name' => 'required|string'
        ];
    }
}
