<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    // Kolom pada tabel permissions yang dapat diisi dengan mass assignment.
    protected $fillable = [
        'name',
        'status',
        'from_when',
        'to_when',
        'submission_date',
        'description'
    ];

    use HasFactory;

    // Fungsi untuk membuat relasi antar tabel permissions dan tabel users.
    public function employee(){
        return $this->belongsTo(User::class);
    }
}
