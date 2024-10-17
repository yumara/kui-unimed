<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class IbmaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasRole('USER');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "study_program" => "required|string|max:64",
            "date_start" => "required|date",
            "date_end" => "required|date",
            "sponsor" => "sometimes|boolean",
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
            "study_program.required" => "Program Studi Wajib Diisi",
            "study_program.string" => "Program Studi Tidak Valid",
            "study_program.max" => "Program Studi terlalu panjang (Maks. 64 karakter)",

            "date_start.required" => "Tanggal Mulai Wajib Diisi",
            "date_start.date" => "Tanggal Mulai Tidak Valid",

            "date_end.required" => "Tanggal Selesai Wajib Diisi",
            "date_end.date" => "Tanggal Selesai Tidak Valid",
        ];
    }
}
