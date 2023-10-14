<?php
namespace App\DataTables\Dashboard\Admin;
use App\Models\Agent;
use App\DataTables\Base\BaseDataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class AgentDataTable extends BaseDataTable {
    public function __construct(DataTableRequest $request) {
        parent::__construct(new Agent());
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Agent $agent) {
                return view('dashboard.admin.agents.btn.actions', compact('agent'));
            })
            ->editColumn('created_at', function (Agent $agent) {
                return $this->formatBadge($this->formatDate($agent->created_at));
            })
            ->editColumn('updated_at', function (Agent $agent) {
                return $this->formatBadge($this->formatDate($agent->updated_at));
            })
            ->editColumn('status', function (Agent $agent) {
                return $this->formatStatus($agent->status);
            })
            ->editColumn('country_id', function (Agent $agent) {
                return $agent->country->name;
            })
            ->rawColumns(['action', 'created_at', 'updated_at','status', 'country_id']); 
    }

    public function query(): QueryBuilder {
        return Agent::latest();
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