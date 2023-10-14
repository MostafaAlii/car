<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\Controller;
use App\Http\Resources\SosResources;
use App\Models\Sos;
use App\Models\Traits\Api\ApiResponseTrait;
use Illuminate\Http\Request;

class SosController extends Controller
{
    use ApiResponseTrait;

    public function index() {
        try {
            return $this->successResponse(SosResources::collection(Sos::active()), 'data Return Successfully');
        } catch (\Exception $exception) {
            $this->errorResponse('Something went wrong, please try again later');
        }
    }

    public function show($id)
    {
        try {
            return $this->successResponse(new SosResources(Sos::findorfail($id)), 'data Return Successfully');
        } catch (\Exception $exception) {
            $this->errorResponse('Something went wrong, please try again later');
        }
    }
}
