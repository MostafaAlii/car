<?php
namespace App\DataTables\Dashboard\General;
use App\Models\Package;
use App\DataTables\Base\BaseDataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class PackageDataTable extends BaseDataTable {
    public function __construct(DataTableRequest $request) {
        parent::__construct(new Package());
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Package $package) {
                return view('dashboard.general.packages.btn.actions', compact('package'));
            })
            ->editColumn('created_at', function (Package $package) {
                return $this->formatBadge($this->formatDate($package->created_at));
            })
            ->editColumn('updated_at', function (Package $package) {
                return $this->formatBadge($this->formatDate($package->updated_at));
            })
            ->editColumn('status', function (Package $package) {
                return $this->StatusChange($package->status,$package->status());
            })
            ->editColumn('admin_id', function (Package $package) {
                return $package?->admin?->name;
            })
            ->editColumn('employee_id', function (Package $package) {
                return $package?->employee?->name;
            })
            ->editColumn('agent_id', function (Package $package) {
                return $package?->agent?->name;
            })
            ->editColumn('company_id', function (Package $package) {
                return $package?->company?->name;
            })
            ->rawColumns(['action', 'created_at', 'updated_at','status', 'admin_id', 'agent_id', 'employee_id', 'company_id']); 
    }

    public function query(): QueryBuilder {
        return Package::latest();
    }

    public function getColumns(): array {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#', 'orderable' => false, 'searchable' => false,],
            ['name' => 'name', 'data' => 'name', 'title' => 'Name',],
            ['name' => 'admin_id', 'data' => 'admin_id', 'title' => 'Admin',],
            ['name' => 'agent_id', 'data' => 'agent_id', 'title' => 'Agent',],
            ['name' => 'employee_id', 'data' => 'employee_id', 'title' => 'Employee',],
            ['name' => 'company_id', 'data' => 'company_id', 'title' => 'Company',],
            ['name' => 'status', 'data' => 'status', 'title' => 'Status',],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => 'Created_at', 'orderable' => false, 'searchable' => false,],
            ['name' => 'action', 'data' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false,],
        ];
    }
}