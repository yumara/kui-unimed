<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class LogInRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user() == null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "email" => "required|email|max:255",
            "password" => "required|string|min:8",
            "remember" => "nullable|boolean|default:false",
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            "email.required" => "Email tidak boleh kosong",
            "email.email" => "Email tidak valid",
            "email.max" => "Email terlalu panjang (max: 255 karakter)",

            "password.required" => "Password tidak boleh kosong",
            "password.string" => "Password tidak valid",
            "password.min" => "Password yang anda masukkan terlalu lemah (min: 8 karakter)"
        ];
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')) . '|' . $this->ip());
    }
}
