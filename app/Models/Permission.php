<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'status',
        'from_when',
        'to_when',
        'submission_date',
        'description'
    ];

    use HasFactory;

    public function employee(){
        return $this->belongsTo(User::class);
    }
}
