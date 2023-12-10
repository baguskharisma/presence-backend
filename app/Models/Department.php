<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    // Kolom pada tabel departments yang dapat diisi dengan mass assignment.
    protected $fillable = [
        'department'
    ];

    use HasFactory;
}
