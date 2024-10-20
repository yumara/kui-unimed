<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class IbmaUploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasRole("USER");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'file' => 'required|mimetypes:image/jpeg,image/jpg,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf|max:2048',
            'field' => 'required|string'
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
            "file.mimetypes" => "Format File tidak diizinkan (Kirimkan file jpg/jpeg/docx/pdf)",
            "file.max" => "Ukuran File terlalu besar (Max 2MB)",

            "field.required" => "Field Kosong",
            "field.string" => "Field Tidak Valid",
        ];
    }
}
