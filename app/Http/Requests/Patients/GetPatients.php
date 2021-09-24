<?php

namespace App\Http\Requests\Patients;

use Illuminate\Foundation\Http\FormRequest;

class GetPatients extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = auth()->user();
        return auth()->check() && $user->account_type == 'doctor';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'offset'     => 'integer|nullable',
            'limit'      => 'integer|nullable',
            'deviations' => 'integer|nullable',
            'search'     => 'string|nullable'
        ];
    }
}
