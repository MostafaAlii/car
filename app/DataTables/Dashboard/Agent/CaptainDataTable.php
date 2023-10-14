<?php
namespace App\DataTables\Dashboard\Agent;
use App\Models\Captain;
use App\DataTables\Base\BaseDataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class CaptainDataTable extends BaseDataTable {
    public function __construct(DataTableRequest $request) {
        parent::__construct(new Captain());
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Captain $captain) {
                return view('dashboard.agent.captains.btn.actions', compact('captain'));
            })
            ->editColumn('created_at', function (Captain $captain) {
                return $this->formatBadge($this->formatDate($captain->created_at));
            })
            ->editColumn('updated_at', function (Captain $captain) {
                return $this->formatBadge($this->formatDate($captain->updated_at));
            })
            ->editColumn('name', function (Captain $captain) {
                return '<a href="'.route('agentCaptains.show', $captain->profile->uuid).'">'.$captain->name.'</a>';
            })
            ->editColumn('status', function (Captain $captain) {
                return $this->formatStatus($captain->status);
            })
            ->editColumn('country_id', function (Captain $captain) {
                return $captain?->country?->name;
            })
            ->rawColumns(['action', 'created_at', 'updated_at','status', 'country_id', 'name']); 
    }

    public function query(): QueryBuilder {
        return Captain::query()->whereCountryId(get_user_data()->country_id);
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