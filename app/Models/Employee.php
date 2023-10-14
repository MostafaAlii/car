<?php
namespace App\Models;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\{HasOne, BelongsTo};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable implements JWTSubject {
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'employees';
    protected $fillable = ['name','email', 'country_id', 'admin_id', 'agent_id', 'password', 'phone', 'status'];
    protected $hidden = ['password','remember_token',];
    protected $casts = ['email_verified_at' => 'datetime','password' => 'hashed',];

    public function profile(): HasOne {
        return $this->hasOne(related:EmployeeProfile::class, foreignKey:'employee_id');
    }

    public function country(): BelongsTo {
        return $this->belongsTo(related:Country::class, foreignKey:'country_id');
    }

    


    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }
}
