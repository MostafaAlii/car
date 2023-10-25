<?php

namespace App\DataTables\Orders;

use App\DataTables\Base\BaseDataTable;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class OrderDataTable extends BaseDataTable {
    public function __construct(DataTableRequest $request) {
        parent::__construct(new Order());
        $this->request = $request;
    }

    public function dataTable(QueryBuilder $query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Order $order) {
                return view('dashboard.admin.orders.btn.actions', compact('order'));
            })
            ->editColumn('client_name', function (Order $order) {
                return $order?->user?->name;
            })
            ->editColumn('captain_name', function (Order $order) {
                return $order?->captain?->name;
            })
            ->rawColumns(['action', 'client_name', 'captain_name']);
    }

    public function query(): QueryBuilder {
        $query = Order::query();
        if ($this->request->has('status')) {
            $status = $this->request->get('status');
            if ($status === 'waiting') {
                $query->whereStatus('waiting');
            } elseif ($status === 'pending') {
                $query->whereStatus('pending');
            } elseif ($status === 'cancel') {
                $query->whereStatus('cancel');
            } elseif ($status === 'accepted') {
                $query->whereStatus('accepted');
            } elseif ($status === 'done') {
                $query->whereStatus('done');
            }
        }
        if ($this->request->has('caption_orders')) {
            $captainId = $this->request->get('caption_orders');
            $query->whereCaptainId($captainId);
        }
        if ($this->request->has('client_orders')) {
            $clientId = $this->request->get('client_orders');
            $query->whereUserId($clientId);
        }
        return $query;
    }

    public function getColumns(): array {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#', 'orderable' => false, 'searchable' => false,],
            ['name' => 'client_name', 'data' => 'client_name', 'title' => 'User-name',],
            ['name' => 'captain_name', 'data' => 'captain_name', 'title' => 'Captain-name',],
            ['name' => 'status', 'data' => 'status', 'title' => 'Status',],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => 'Created_at', 'orderable' => false, 'searchable' => false,],
            ['name' => 'action', 'data' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false,],
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Order_' . date('YmdHis');
    }
}
