<?php
namespace App\Http\Requests\Dashboard\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class SectionRequestValidation extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules(){
        $id = $this->route('section');
        $rules = [
            'name' => 'required|unique:sections,name',
            'status' => 'required|in:active,inactive',
            
        ];
        if ($this->isMethod('post')) {
            $rules['country_id'] = 'required|exists:countries,id';
            
        } else {
            $rules['country_id'] = 'nullable|exists:countries,id';
        }
        return $rules;
    }
}