<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string password
 * @property string name
 * @property string email
 * @property string phone
 * @property string account_type
 */
class Register extends FormRequest
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
    public function rules(): array
    {
        return [
            'first_name' => 'required|max:55',
            'last_name' => 'required|max:55',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'phone' => 'required|phone:AUTO',
            'account_type' => 'required|in:mom,doctor'
        ];
    }
}
