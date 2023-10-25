<?php
namespace App\Http\Controllers\Dashboard\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Orders\OrderDataTable;
use App\Http\Requests\Dashboard\Admin\AdminRequestValidation;
use App\Models\Order;
class OrderController extends Controller {
    public function __construct(protected OrderDataTable $dataTable) {
        $this->dataTable = $dataTable;
    }
    public function index() {
        $status = request()->input('status', null);
        $title = 'Orders';
        if ($status)
            $title .= ' ' . ucfirst($status);
        return $this->dataTable->render('dashboard.admin.orders.index', ['title' => $title]);
    }

    public function show($orderCode) {
        $order = Order::where('order_code', $orderCode)->first();
        $orderTracking = Order::where('id', $order->id)->get(['user_id', 'captain_id', 'trip_type_id','id', 'lat_user', 'long_user', 'lat_going', 'long_going']);
        $locations = [];
        foreach ($orderTracking as $orderTrack) {
            $locations[] = [
                'id' => $orderTrack->id,
                'lat_user' => $orderTrack->lat_user,
                'long_user' => $orderTrack->long_user,
                'lat_going' => $orderTrack->lat_going,
                'long_going' => $orderTrack->long_going,
                'user_id' => $orderTrack->user->name,
                'captain_id' => $orderTrack->captain->name,
                'trip_type_id' => $orderTrack->trip_type->name,
            ];
        }
        return view('dashboard.admin.orders.show', ['order' => $order, 'data' => json_encode($locations)]);
    }
}