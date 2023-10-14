<?php
declare (strict_types = 1);
namespace App\Observers;
use App\Models\Company;
class CompanyObserver {
    public function created(Company $company): void {
        $company->profile()->create([]);
    }

    public function deleting(Company $company): void {
        $medias = $company->getMedia();
        foreach ($medias as $media) {
            $media->delete();
        }
    }
    
}