<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class UserProfile extends BaseModel {
    protected $table = 'user_profiles';
    protected $fillable = ['address','bio','user_id', 'uuid', 'avatar','rate','number_trips','number_trips_cansel'];

    public function owner(): BelongsTo {
        return $this->belongsTo(related:User::class, foreignKey:'user_id');
    }

    public function userWallet()
    {
        return $this->hasMany(Wallet::class,'user_id')->sum('amount');
    }
}
