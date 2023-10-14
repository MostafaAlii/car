<?php

namespace App\Models;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable implements JWTSubject {
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'admins';
    protected $fillable = ['name','email','password' ,'phone', 'status', 'password',];
    protected $hidden = ['remember_token',];
    protected $casts = ['email_verified_at' => 'datetime','password' => 'hashed',];

    public function profile(): HasOne {
        return $this->hasOne(related:AdminProfile::class, foreignKey:'admin_id');
    }

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    public function scopeActive() {
        return $this->whereStatus('active')->get();
    }
}