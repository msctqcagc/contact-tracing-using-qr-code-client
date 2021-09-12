<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    use HasFactory;

    protected $casts = [
        'is_active' => 'boolean',
        'deleted_at' => 'datetime'
    ];
}
