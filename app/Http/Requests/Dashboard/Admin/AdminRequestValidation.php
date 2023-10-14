<?php
namespace App\Http\Requests\Dashboard\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class AdminRequestValidation extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules(){
        $id = $this->route('admin');
        $rules = [
            'name' => 'required|string|max:255',
            'email' => $this->getEmailRules($id),
            'phone' => 'required|numeric',
            'status' => 'required|in:active,inactive',
        ];
        if ($this->isMethod('post'))
            $rules['password'] = 'required|min:6';
        $rules['password'] = 'nullable|min:6';
        return $rules;
    }

    private function getEmailRules($id) {
        return [
            'required',
            'email',
            Rule::unique('admins', 'email')->ignore($id),
        ];
    }
}