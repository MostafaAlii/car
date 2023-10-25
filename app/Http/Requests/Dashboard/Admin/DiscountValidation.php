<?php
namespace App\Http\Requests\Dashboard\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class DiscountValidation extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules(){
        $now = date('m/d/Y H:i:s.u');
        return [
            'start_data' => 'date_format:m/d/Y|after_or_equal:'.$now,
            'end_data' => 'date_format:m/d/Y|after:start_data',
            'code' => 'required|unique:discount,code',
            'status' => 'required|in:0,1',
            'type' => 'required|in:fixed,cash',
            'value' => 'required|numeric',
        ];
    }
}