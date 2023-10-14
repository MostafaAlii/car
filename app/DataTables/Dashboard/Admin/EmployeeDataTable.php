<?php
namespace App\DataTables\Dashboard\Admin;
use App\Models\Employee;
use App\DataTables\Base\BaseDataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class EmployeeDataTable extends BaseDataTable {
    public function __construct(DataTableRequest $request) {
        parent::__construct(new Employee());
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Employee $employee) {
                return view('dashboard.admin.employees.btn.actions', compact('employee'));
            })
            ->editColumn('created_at', function (Employee $employee) {
                return $this->formatBadge($this->formatDate($employee->created_at));
            })
            ->editColumn('updated_at', function (Employee $employee) {
                return $this->formatBadge($this->formatDate($employee->updated_at));
            })
            ->editColumn('status', function (Employee $employee) {
                return $this->formatStatus($employee->status);
            })
            ->editColumn('country_id', function (Employee $employee) {
                return $employee?->country?->name;
            })
            ->rawColumns(['action', 'created_at', 'updated_at','status', 'country_id']); 
    }

    public function query(): QueryBuilder {
        return Employee::latest();
    }

    public function getColumns(): array {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#', 'orderable' => false, 'searchable' => false,],
            ['name' => 'name', 'data' => 'name', 'title' => 'Name',],
            ['name' => 'email', 'data' => 'email', 'title' => 'Email',],
            ['name' => 'phone', 'data' => 'phone', 'title' => 'Phone',],
            ['name' => 'country_id', 'data' => 'country_id', 'title' => 'Country',],
            ['name' => 'status', 'data' => 'status', 'title' => 'Status',],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => 'Created_at', 'orderable' => false, 'searchable' => false,],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => 'Update_at', 'orderable' => false, 'searchable' => false,],
            ['name' => 'action', 'data' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false,],
        ];
    }
}