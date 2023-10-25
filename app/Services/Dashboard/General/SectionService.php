<?php
namespace App\Services\Dashboard\General;
use App\Models\Section;
class SectionService {

    public function create($data) {
        if(auth()->guard('admin')->check())
            $data['admin_id'] = get_user_data()->id;
        if(auth()->guard('agent')->check())
            $data['agent_id'] = get_user_data()->id;
        return Section::create($data);
    }
    public function update($sectionId, $requestData) {
        if(auth()->guard('admin')->check())
            $requestData['admin_id'] = get_user_data()->id;
        if(auth()->guard('agent')->check())
            $requestData['agent_id'] = get_user_data()->id;
        $section = Section::findOrFail($sectionId);
        $section->fill($requestData);
        $section->save();
        return $section;
    }

    public function updateStatus($sectionId, $status) {
        $section = Section::findOrFail($sectionId);
        $section->status = $status;
        $section->save();
        return $section;
    }

    public function delete($sectionId) {
        $section = Section::findOrFail($sectionId);
        $section->delete();
        return $section;
    }
}