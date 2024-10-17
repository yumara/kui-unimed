<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IbmaSponsor extends Model
{
    use HasFactory;
    protected $table = 'ibma_sponsor';

    protected $fillable = [
        'ibma_id',
        'name',
        'type',
        'file_sponsor',
    ];
}
