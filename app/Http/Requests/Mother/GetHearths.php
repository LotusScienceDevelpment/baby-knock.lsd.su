<?php

namespace App\Http\Requests\Mother;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property integer limit
 * @property integer offset
 */
class GetHearths extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'limit' => 'required|integer',
            'offset' => 'required|integer'
        ];
    }
}
