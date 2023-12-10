<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    // Kolom pada tabel users yang dapat diisi dengan mass assignment.
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'address',
        'birth',
        'gender',
        'position_id',
        'role_id',
        'department_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Fungsi untuk membuat relasi antar tabel users dan tabel positions. 
    public function position(){
        return $this->belongsTo(Position::class, 'position_id');
    }

    // Fungsi untuk membuat relasi antar tabel users dan tabel roles.
    public function role(){
        return $this->belongsTo(Role::class, 'role_id');
    }

    // Fungsi untuk membuat relasi antar tabel users dan tabel departments.
    public function department(){
        return $this->belongsTo(Department::class, 'department_id');
    }

    // Fungsi untuk membuat relasi antar tabel users dan tabel presences.
    public function presence(){
        return $this->hasMany(Presence::class);
    }

    // Fungsi untuk membuat relasi antar tabel users dan tabel permissions.
    public function permission(){
        return $this->hasMany(Permission::class, 'name');
    }
}
