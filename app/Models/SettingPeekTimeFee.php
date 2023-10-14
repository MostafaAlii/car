<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class SettingPeekTimeFee extends Model {
    use HasFactory;
    protected $table = "setting_peek_time_fees";
    protected $fillable = [
        'settings_id',
        'start_date',
        'end_date',
        'price'
    ];
    public $timestamps = false;
    public function setting(): BelongsTo {
        return $this->belongsTo(Settings::class, 'settings_id');
    }
}
