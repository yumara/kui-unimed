<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IBMA extends Model
{
    use HasFactory;
    protected $table = 'ibma';

    protected $fillable = [
        'user_id',
        'study_program',
        'date_start',
        'date_end',
        'sponsor',
        'status',
        'file_passport',
        'file_sk_sehat',
        'file_soc',
        'file_sofs',
        'file_ijazah_transkrip',
    ];

    protected function casts(): array
    {
        return [
            'date_start' => 'date:Y-m-d',
            'date_end' => 'date:Y-m-d',
        ];
    }

    public function isFileComplete() : bool {
        $fields = [
            'file_passport' => 'Paspor',
            'file_sk_sehat' => 'SK Sehat',
            'file_soc' => 'Surat Pernyataan',
            'file_sofs' => 'Surat Pernyataan Kesanggupan Pembayaran',
            'file_ijazah_transkrip' => 'Ijazah & Transkrip',
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
}
