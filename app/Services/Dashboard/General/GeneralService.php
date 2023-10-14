<?php
namespace App\Services\Dashboard\General;
use App\Models\Country;
class GeneralService {
    public function getCountries() {
        return Country::active();
    }
}