<?php

namespace App\Http\Controllers\Api\Drivers;

use App\Http\Controllers\Controller;
use App\Http\Resources\Drivers\OrdersResources;
use App\Models\Order;
use App\Models\Traits\Api\ApiResponseTrait;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ApiResponseTrait;

     public function index()
    {
        $captainId = auth('captain-api')->id();

        $orders = Order::byCaptain($captainId)
            ->whereIn('status', ['done', 'cancel'])
              ->orderBy('id', 'DESC')
            ->paginate(5);

        $data = OrdersResources::collection($orders);
        $pagination = $orders->toArray();
        unset($pagination['data']); // Remove the 'data' key from pagination

        $response = [
            'data' => $data,
            'pagination' => $pagination,
        ];

        return $this->successResponse($response, 'Data returned successfully');
    }
}
