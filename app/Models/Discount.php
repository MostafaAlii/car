<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'start_data',
        'end_data',
        'description',
        'use_coupon',
        'used_coupon',
        'value',
        'couponsUsed',
        'status',
    ];

    public function status()
    {
        return $this->status != false ? 'Acrive' : 'No Active';
    }

    protected $dates = ['start_data', 'end_data'];

    public function discount($total)
    {
        if (!$this->checkData() || !$this->checkUsedTimes()) {
            return 0;
        }
        return $this->checkGreaterThan($total) ? $this->doProcess($total) : 0;
    }


    protected function checkData()
    {
        return $this->end_data != null ? (Carbon::now()->between($this->start_data, $this->end_data, true)) ? true : false : true;
    }

    protected function checkUsedTimes()
    {
        return $this->used_coupon != null ? ($this->use_coupon > $this->used_coupon) ? true : false : true;
    }

    protected function checkGreaterThan($total)
    {
        return $this->couponsUsed != null ? ($total >= $this->couponsUsed) ? true : false : true;
    }

    protected function doProcess($total)
    {
        switch ($this->type) {
            case "fixed":
                return $this->value;
                break;
            case 'cash' :
                return ($this->value / 100) * $total;

            default:
                return 0;
        }
    }
}
