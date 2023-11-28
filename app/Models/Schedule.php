<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'date',
        'in_time',
        'out_time',
        'status',
        'description'
    ];

    public function presence()
    {
        return $this->hasMany(Presence::class);
    }
}
