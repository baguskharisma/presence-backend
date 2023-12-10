<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    // Kolom pada tabel presences yang dapat diisi dengan mass assignment.
    protected $fillable = [
        'name',
        'status',
        'date',
        'time'
    ];

    // Fungsi untuk membuat relasi antar tabel presences dan tabel users.
    public function employee()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Fungsi untuk membuat relasi antar tabel presences dan tabel schedules.
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
