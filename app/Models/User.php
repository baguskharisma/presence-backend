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
    protected $table = 'users';
    protected $primaryKey = 'id';

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

    public function position(){
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function role(){
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function department(){
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function presence(){
        return $this->hasMany(Presence::class);
    }

    public function permission(){
        return $this->hasMany(Permission::class, 'name');
    }
}
