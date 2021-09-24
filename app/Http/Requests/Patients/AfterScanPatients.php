<?php

namespace App\Http\Requests\Patients;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string device_id
 */
class AfterScanPatients extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->account_type == 'doctor';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'device_id' => 'required|string'
        ];
    }
}
