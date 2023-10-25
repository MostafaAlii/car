<?php
namespace App\Services\Dashboard\General;
use App\Models\Country;
class CountryService {
    public function updateStatus($countryId, $status) {
        $country = Country::findOrFail($countryId);
        $country->status = $status;
        $country->save();
        return $country;
    }
}