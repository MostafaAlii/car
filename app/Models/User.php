<?php
namespace App\Models;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable implements JWTSubject {
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'users';
    protected $fillable = ['name','email','country_id','password', 'gender','phone', 'country_id', 'fcm_token', 'status','password'];
    protected $hidden = ['remember_token',];
    protected $casts = ['email_verified_at' => 'datetime','password' => 'hashed',];

    public function profile() {
        return $this->hasOne(UserProfile::class, 'user_id');
    }


    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }




}
