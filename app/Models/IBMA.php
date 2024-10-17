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
    ];

    protected function casts(): array
    {
        return [
            'date_start' => 'date:Y-m-d',
            'date_end' => 'date:Y-m-d',
        ];
    }
}
