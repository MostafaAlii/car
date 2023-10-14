<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\Orders\OrdersResources;
use App\Models\Order;
use App\Models\Traits\Api\ApiResponseTrait;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $orders = Order::where('user_id', auth('users-api')->id())
            ->whereIn('status', ['done', 'cancel'])
            ->paginate(15);

        $data = OrdersResources::collection($orders);
        $response = [
            'data' => $data,
            'pagination' => [
                'total' => $data->total(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'from' => $data->firstItem(),
                'to' => $data->lastItem(),
                'next_page_url' => $data->nextPageUrl(),
            ],
        ];
        return $this->successResponse($response, 'data return successfully');
    }


    public function lasts()
    {
        $orders = Order::where('user_id', auth('users-api')->id())->latest()->take(2)->get();
        return $this->successResponse(OrdersResources::collection($orders), 'data return successfully');
    }
}
