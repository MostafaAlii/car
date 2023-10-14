<?php
namespace App\DataTables\Dashboard\Admin\Cars;
use App\Models\CarModel;
use App\DataTables\Base\BaseDataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class CarModelDataTable extends BaseDataTable {
    public function __construct(DataTableRequest $request) {
        parent::__construct(new CarModel());
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (CarModel $carModel) {
                return view('dashboard.admin.cars.CarModel.btn.actions', compact('carModel'));
            })
            ->editColumn('created_at', function (CarModel $carModel) {
                return $this->formatBadge($this->formatDate($carModel->created_at));
            })
            ->editColumn('updated_at', function (CarModel $carModel) {
                return $this->formatBadge($this->formatDate($carModel->updated_at));
            })
            ->editColumn('status', function (CarModel $carModel) {
                return $carModel->status();
            })
            ->editColumn('car_make_id', function (CarModel $carModel) {
                return $carModel->car_make->name;
            })
            ->rawColumns(['action', 'created_at', 'updated_at','status', 'car_make_id']); 
    }

    public function query(): QueryBuilder {
        return CarModel::latest();
    }

    public function getColumns(): array {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#', 'orderable' => false, 'searchable' => false,],
            ['name' => 'name', 'data' => 'name', 'title' => 'Name',],
            ['name' => 'status', 'data' => 'status', 'title' => 'Status',],
            ['name' => 'car_make_id', 'data' => 'car_make_id', 'title' => 'Car Make',],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => 'Created_at', 'orderable' => false, 'searchable' => false,],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => 'Update_at', 'orderable' => false, 'searchable' => false,],
            ['name' => 'action', 'data' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false,],
        ];
    }
}