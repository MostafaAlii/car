<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\{HasOne, BelongsTo};
use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Sanctum\HasApiTokens;
class Captain extends Authenticatable implements JWTSubject {
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'captains';
    protected $fillable = ['name','email','password', 'phone', 'gender', 'country_id',
    'admin_id',
    'agent_id',
    'company_id',
    'employee_id', 'fcm_token', 'status'];
    protected $hidden = ['password','remember_token',];
    protected $casts = ['email_verified_at' => 'datetime','password' => 'hashed',];

    public function profile(): HasOne {
        return $this->hasOne(related:CaptainProfile::class, foreignKey:'captain_id');
    }

    public function country(): BelongsTo {
        return $this->belongsTo(related:Country::class, foreignKey:'country_id');
    }

    public function car(): HasOne {
        return $this->hasOne(related:CarsCaption::class, foreignKey:'captain_id');
    }

    public function admin(): BelongsTo {
        return $this->belongsTo(related:Admin::class, foreignKey:'admin_id');
    }

    public function employee(): BelongsTo {
        return $this->belongsTo(related:Employee::class, foreignKey:'employee_id');
    }

    public function agent(): BelongsTo {
        return $this->belongsTo(related:Agent::class, foreignKey:'agent_id');
    }

    public function notifications() {
        return $this->hasMany(related:Notification::class, foreignKey:'captains_id');
    }

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    public function captainActivity() {
        return $this->hasOne(related:CaptionActivity::class, foreignKey:'captain_id');
    }

    public function captainProfile()
    {
        return $this->hasOne(CaptainProfile::class,'captain_id');
    }

    public function captaincar()
    {
        return $this->hasOne(CarsCaption::class,'captain_id');
    }

    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }
}
