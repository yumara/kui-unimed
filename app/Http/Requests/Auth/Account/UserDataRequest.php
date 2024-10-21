<?php

namespace App\Http\Requests\Auth\Account;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user() != null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string|max:64",
            "gender" => [
                "required",
                Rule::in(["L","P"]),
            ],
            "place_birth" => "required|string|max:64",
            "date_birth" => "required|date",
            "phone_number" => "required|string|max:20",
            "email" => "required|email|max:255",
            "address" => "nullable|string",
            "city" => "nullable|string",
            "country" => "nullable|string",
            "zipcode" => "nullable|string",
            "citizenship" => "nullable|string",
            "occupation" => "nullable|string",
            "passport_id" => "nullable|string",
            "study_program" => "nullable|string",
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
            "name.required" => "Nama tidak boleh kosong",
            "name.string" => "Nama tidak valid",
            "name.max" => "Nama terlalu panjang (maks: 64 karakter)",

            "gender.required" => "Jenis Kelamin tidak boleh kosong",
            "gender.in" => "Jenis Kelamin tidak valid",

            "place_birth.required" => "Tempat Lahir tidak boleh kosong",
            "place_birth.string" => "Tempat Lahir tidak valid",
            "place_birth.max" => "Tempat Lahir terlalu panjang (maks: 64 karakter)",

            "date_birth.required" => "Tanggal Lahir Wajib Diisi",
            "date_birth.date" => "Tanggal Lahir Tidak Valid",

            "phone_number.required" => "Nomor Telepon tidak boleh kosong",
            "phone_number.string" => "Nomor Telepon tidak valid",
            "phone_number.max" => "Nomor Telepon terlalu panjang (maks: 20 karakter)",

            "email.required" => "Email tidak boleh kosong",
            "email.email" => "Email tidak valid",
            "email.max" => "Email terlalu panjang (max: 255 karakter)",

            "address.string" => "Alamat tidak valid",
            "city.string" => "Kota tidak valid",
            "country.string" => "Negara tidak valid",
            "zipcode.string" => "Kode Pos tidak valid",
            "citizenship.string" => "Kewarganegaraan tidak valid",
            "occupation.string" => "Pekerjaan tidak valid",
            "passport_id.string" => "Nomor Paspor tidak valid",
            "study_program.string" => "Program Studi tidak valid",
        ];
    }
}
