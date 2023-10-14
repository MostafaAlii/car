<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class SettingsTranslation extends Model {
    use HasFactory;
    protected $table ='settings_translation';
    protected $fillable = ['name', 'author', 'address', 'description', 'road_toll'];
    public $timestamps = false;
}
