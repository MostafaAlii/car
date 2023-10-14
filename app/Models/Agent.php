<?php
namespace App\Models;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\{HasOne,BelongsTo};

class Agent extends Authenticatable implements JWTSubject {
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'agents';
    protected $fillable = ['name','email','password', 'admin_id', 'country_id' ,'phone', 'status'];
    protected $hidden = ['password','remember_token',];
    protected $casts = ['email_verified_at' => 'datetime','password' => 'hashed',];

    public function profile(): HasOne {
        return $this->hasOne(related:AgentProfile::class, foreignKey:'agent_id');
    }

    public function country(): BelongsTo {
        return $this->belongsTo(related:Country::class, foreignKey:'country_id');
    }

    public function admin(): BelongsTo {
        return $this->belongsTo(related:Admin::class, foreignKey:'admin_id');
    }

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }
}