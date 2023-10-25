<?php
namespace App\DataTables\Dashboard\General;
use App\Models\City;
use App\DataTables\Base\BaseDataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class CityDataTable extends BaseDataTable {
    public function __construct(DataTableRequest $request) {
        parent::__construct(new City());
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($row) {
                return view('dashboard.general.cities.btn.actions', compact('row'));
            })
            ->editColumn('status', function (City $city) {
                return $this->StatusChange($city->status,$city->status());
            })
            ->editColumn('state', function (City $city) {
                return $city->state->name;
            })
        ->rawColumns(['action','created_at', 'updated_at', 'status','state']);
    }

    public function query(): QueryBuilder{

        return City::query();
    }

    protected function getColumns(): array {
        return [
            ['name'=>'id','data'=>'id','title'=>'#','orderable'=>false,'searchable'=>false,],
            ['name'=>'name','data'=>'name','title'=> 'Name',],
            ['name'=>'state','data'=> 'state','title'=> 'State',],
            ['name'=>'status','data'=> 'status','title'=> 'Status',],
            ['name'=>'action','data'=> 'action','title'=>'Actions','exportable'=>false,'printable'=>false,'orderable'=>false,'searchable'=>false,],
        ];
    }
}