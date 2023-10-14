<?php
namespace App\Http\Resources\MainSetting;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MainSetting\SettingPeekTimeFeeResource;
class MainSettingResources extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'phone' => $this->phone,
            'whatsapp' => $this->whatsapp,
            'email' => $this->email,
            'version' => $this->version,
            'open_door' => $this->open_door,
            'waiting_price' => $this->waiting_price,
            'country_tax' => $this->country_tax,
            'kilo_price' => $this->kilo_price,
            'ocean' => $this->ocean,
            'company_commission' => $this->company_commission,
            'company_tax' => $this->company_tax,
            'peek_time_fees' => SettingPeekTimeFeeResource::collection($this->peekTimeFees),
            'name' => $this->translations->keyBy('locale')->map->only('name'),
            'author' => $this->translations->keyBy('locale')->map->only('author'),
            'address' => $this->translations->keyBy('locale')->map->only('address'),
            'description' => $this->translations->keyBy('locale')->map->only('description'),
            'road_toll' => $this->translations->keyBy('locale')->map->only('road_toll')
        ];
    }
}