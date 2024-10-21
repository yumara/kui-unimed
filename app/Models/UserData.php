<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class UserData extends Model
{
    use HasFactory;

    protected $table = 'user_data';
    protected $primaryKey = 'user_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'place_birth',
        'date_birth',
        'address',
        'city',
        'country',
        'citizenship',
        'passport_id',
        'occupation',
        'phone_number',
        'study_program',
    ];

    protected function casts(): array
    {
        return [
            'date_birth' => 'date:Y-m-d',
        ];
    }

    /**
     * Get the user that owns the user data.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isComplete() : bool {
        $fields = [
            'gender' => 'Jenis Kelamin',
            'address' => 'Alamat',
            'phone_number' => 'Nomor Telepon',
            'date_birth' => 'Tanggal Lahir',
            'place_birth' => 'Tempat Lahir',
            'city' => 'Kota',
            'country' => 'Negara',
            'zipcode' => 'Kode Pos',
            'citizenship' => 'Kewarganegaraan',
            'passport_id' => 'Nomor Paspor',
            'file_pasfoto' => 'Pas Foto',
            // Tambahkan field lain di sini sesuai kebutuhan
        ];

        $fieldsNotFilled = [];
        foreach ($fields as $field => $label) {
            if (empty($this->$field)) {
                $fieldsNotFilled[] = $label;
            }
        }

        return empty($fieldsNotFilled);
    }

    function getPhotoWithNullcheck() : string {
        return (!empty($this->file_pasfoto))? route('files',["folder" => "user","id" => $this->user_id, "file" => $this->file_pasfoto])  : asset('images/users/empty.png');
    }
}
