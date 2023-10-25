<?php
namespace App\Services\Dashboard\General;
use App\Models\Discount;
class DiscountService {

    public function create($data) {
        return Discount::create($data);
    }
    public function update($discountId, $requestData) {
        $discount = Discount::findOrFail($discountId);
        $discount->fill($requestData);
        $discount->save();
        return $discount;
    }

    public function updateStatus($discountId, $status) {
        $discount = Discount::findOrFail($discountId);
        $discount->status = $status;
        $discount->save();
        return $discount;
    }

    public function delete($discountId) {
        $discount = Discount::findOrFail($discountId);
        $discount->delete();
        return $discount;
    }
}