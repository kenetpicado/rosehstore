<?php

namespace App\Models;

use App\Casts\LowerCaseCast;
use App\Casts\UcwordsCast;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'email' => LowerCaseCast::class,
        'name' => UcwordsCast::class,
    ];

    public function setPassword()
    {
        $this->password = bcrypt('12345678');
    }

    public function scopeNoRootUsers($query)
    {
        return $query->whereHas('roles', fn($q) => $q->where('name', '!=', 'root'));
    }

    public function scopeAdmins($query)
    {
        return $query->whereHas('roles', fn($q) => $q->where('name', 'administrador'));
    }
}
