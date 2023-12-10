<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    // Kolom pada tabel schedules yang dapat diisi dengan mass assignment.
    protected $fillable = [
        'day',
        'date',
        'in_time',
        'out_time',
        'status',
        'description'
    ];

    // Fungsi untuk membuat relasi antar tabel schedules dan tabel presences.
    public function presence()
    {
        return $this->hasMany(Presence::class);
    }
}
