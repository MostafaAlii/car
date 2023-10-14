<?php
namespace App\Http\Requests\Dashboard\Admin\Cars;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class CarModelRequestValidation extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules(){
        $rules = [
            'name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
            'car_make_id' => 'exists:car_makes,id',
        ];
        return $rules;
    }
}