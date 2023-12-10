<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    // Kolom pada tabel positions yang dapat diisi dengan mass assignment.
    protected $fillable = [
        'position'
    ];

    use HasFactory;
}
