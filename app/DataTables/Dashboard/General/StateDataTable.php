<?php
namespace App\DataTables\Dashboard\General;
use App\Models\State;
use App\DataTables\Base\BaseDataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class StateDataTable extends BaseDataTable {
    public function __construct(DataTableRequest $request) {
        parent::__construct(new State());
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($row) {
                return view('dashboard.general.states.btn.actions', compact('row'));
            })
            ->editColumn('status', function (State $state) {
                return $this->StatusChange($state->status,$state->status());
            })
            ->editColumn('country_id', function (State $state) {
                return $state->country->name;
            })
            ->addColumn('cities_count', function (State $state) {
                return count($state->cities);
            })
        ->rawColumns(['action','created_at', 'updated_at', 'status', 'country_id', 'cities_count']);
    }

    public function query(): QueryBuilder{

        return State::with('cities');
    }

    protected function getColumns(): array {
        return [
            ['name'=>'id','data'=>'id','title'=>'#','orderable'=>false,'searchable'=>false,],
            ['name'=>'name','data'=>'name','title'=> 'Name',],
            ['name'=>'country_id','data'=> 'country_id','title'=> 'Related Country',],
            ['name'=>'cities_count','data'=> 'cities_count','title'=> 'Cities',],
            ['name'=>'status','data'=> 'status','title'=> 'Status',],
            ['name'=>'action','data'=> 'action','title'=>'Actions','exportable'=>false,'printable'=>false,'orderable'=>false,'searchable'=>false,],
        ];
    }
}