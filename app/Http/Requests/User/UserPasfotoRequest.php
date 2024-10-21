<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserPasfotoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !empty(auth()->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'file' => 'required|mimetypes:image/jpeg,image/jpg,image/png|max:2048',
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
            "file.required" => "Harap masukkan File yang akan diupload",
            "file.mimetypes" => "Format File tidak diizinkan (Kirimkan file jpg/jpeg/png)",
            "file.max" => "Ukuran File terlalu besar (Max 2MB)",
        ];
    }
}
