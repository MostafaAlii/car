<?php
namespace App\Http\Resources\MainSetting;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class SettingPeekTimeFeeResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'price' => $this->price,
        ];
    }
}