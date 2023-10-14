<?php
namespace App\DataTables\Dashboard\Admin;
use App\Models\TripType;
use App\DataTables\Base\BaseDataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class TripTypeDataTable extends BaseDataTable {
    public function __construct(DataTableRequest $request) {
        parent::__construct(new TripType());
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (TripType $tripType) {
                return view('dashboard.admin.tripType.btn.actions', compact('tripType'));
            })
            ->editColumn('created_at', function (TripType $tripType) {
                return $this->formatBadge($this->formatDate($tripType->created_at));
            })
            ->editColumn('updated_at', function (TripType $tripType) {
                return $this->formatBadge($this->formatDate($tripType->updated_at));
            })
            ->editColumn('status', function (TripType $tripType) {
                return $tripType->status();
            })
            ->rawColumns(['action', 'created_at', 'updated_at','status']); 
    }

    public function query(): QueryBuilder {
        return TripType::latest();
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