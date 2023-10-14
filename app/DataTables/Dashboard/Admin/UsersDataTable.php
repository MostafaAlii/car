<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class UsersDataTable extends BaseDataTable
{
    public function __construct(DataTableRequest $request) {
        parent::__construct(new User());
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (User $admin) {
                return view('dashboard.admin.users.btn.actions', compact('admin'));
            })
            ->editColumn('created_at', function (User $admin) {
                return $this->formatBadge($this->formatDate($admin->created_at));
            })
            ->editColumn('updated_at', function (User $admin) {
                return $this->formatBadge($this->formatDate($admin->updated_at));
            })
            ->editColumn('status', function (User $admin) {
                return $this->formatStatus($admin->status);
            })
            ->rawColumns(['action', 'created_at', 'updated_at','status']);
    }

    public function query(): QueryBuilder {
        return User::latest();
    }

    public function getColumns(): array {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#', 'orderable' => false, 'searchable' => false,],
            ['name' => 'name', 'data' => 'name', 'title' => 'Name',],
            ['name' => 'email', 'data' => 'email', 'title' => 'Email',],
            ['name' => 'status', 'data' => 'status', 'title' => 'Status',],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => 'Created_at', 'orderable' => false, 'searchable' => false,],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => 'Update_at', 'orderable' => false, 'searchable' => false,],
            ['name' => 'action', 'data' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false,],
        ];
    }
}