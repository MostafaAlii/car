<?php
namespace App\DataTables\Dashboard\Admin;
use App\Models\Sos;
use App\DataTables\Base\BaseDataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class SosDataTable extends BaseDataTable {
    public function __construct(DataTableRequest $request) {
        parent::__construct(new Sos());
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Sos $sos) {
                return view('dashboard.admin.sos.btn.actions', compact('sos'));
            })
            ->editColumn('created_at', function (Sos $sos) {
                return $this->formatBadge($this->formatDate($sos->created_at));
            })
            ->editColumn('updated_at', function (Sos $sos) {
                return $this->formatBadge($this->formatDate($sos->updated_at));
            })
            ->editColumn('status', function (Sos $sos) {
                return $this->formatStatus($sos->status);
            })
            ->editColumn('admin_id', function (Sos $sos) {
                return $sos?->admin?->name;
            })
            ->rawColumns(['action', 'created_at', 'updated_at','status', 'admin_id']); 
    }

    public function query(): QueryBuilder {
        return Sos::latest();
    }

    public function getColumns(): array {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#', 'orderable' => false, 'searchable' => false,],
            ['name' => 'name', 'data' => 'name', 'title' => 'Name',],
            ['name' => 'number', 'data' => 'number', 'title' => 'Number',],
            ['name' => 'admin_id', 'data' => 'admin_id', 'title' => 'Admin',],
            ['name' => 'status', 'data' => 'status', 'title' => 'Status',],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => 'Created_at', 'orderable' => false, 'searchable' => false,],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => 'Update_at', 'orderable' => false, 'searchable' => false,],
            ['name' => 'action', 'data' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false,],
        ];
    }
}