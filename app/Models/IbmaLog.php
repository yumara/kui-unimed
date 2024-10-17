<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IbmaLog extends Model
{
    use HasFactory;
    protected $table = 'ibma_log';

    protected $fillable = [
        'ibma_id',
        'status',
        'desc',
        'created_by',
        'user_id',
    ];

}
