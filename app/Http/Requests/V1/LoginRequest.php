<?php

namespace App\Http\Requests\V1;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
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
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'email is required',
            'email.exists' => 'Model not found.',
            'email.email' => 'email is invalid',
            'password.required' => 'password is required',
            'password.min' => 'password is invalid',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 422,
            'message' => $validator->errors()->all()[0],
        ], 422));
    }
}
