<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|confirmed'
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
            'name.required' => 'Nama tidak boleh kosong',
            'name.max' => 'Nama terlalu panjang (max: 255 karakter)',

            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.max' => 'Email terlalu panjang (max: 255 karakter)',
            'email.unique' => 'Email yang anda masukkan sudah terdaftar',

            'password.required' => 'Password tidak boleh kosong',
            'password.string' => 'Password tidak valid',
            'password.min' => 'Password yang anda masukkan terlalu lemah (min: 8 karakter)',
            'password.confirmed' => 'Password tidak sama'
        ];
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate($this->ip());
    }
}
