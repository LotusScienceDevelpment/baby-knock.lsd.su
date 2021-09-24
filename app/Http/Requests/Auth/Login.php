<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property string phone
 * @property string password
 * @property string account_type
 */
class Login extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['phone' => "string", 'password' => "string", 'account_type' => 'string'])]
    public function rules(): array
    {
        return [
            'phone'        => 'required|string|phone:AUTO',
            'password'     => 'required|string',
            'account_type' => 'required|in:mom,doctor'
        ];
    }
}
