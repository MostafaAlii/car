<?php
namespace App\DataTables\Dashboard\Admin\Cars;
use App\Models\CarType;
use App\DataTables\Base\BaseDataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class CarTypeDataTable extends BaseDataTable {
    public function __construct(DataTableRequest $request) {
        parent::__construct(new CarType());
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (CarType $carType) {
                return view('dashboard.admin.cars.carType.btn.actions', compact('carType'));
            })
            ->editColumn('created_at', function (CarType $carType) {
                return $this->formatBadge($this->formatDate($carType->created_at));
            })
            ->editColumn('updated_at', function (CarType $carType) {
                return $this->formatBadge($this->formatDate($carType->updated_at));
            })
            ->editColumn('status', function (CarType $carType) {
                return $carType->status();
            })
            ->rawColumns(['action', 'created_at', 'updated_at','status']); 
    }

    public function query(): QueryBuilder {
        return CarType::latest();
    }

    public function getColumns(): array {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#', 'orderable' => false, 'searchable' => false,],
            ['name' => 'name', 'data' => 'name', 'title' => 'Name',],
            ['name' => 'status', 'data' => 'status', 'title' => 'Status',],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => 'Created_at', 'orderable' => false, 'searchable' => false,],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => 'Update_at', 'orderable' => false, 'searchable' => false,],
            ['name' => 'action', 'data' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false,],
        ];
    }
}