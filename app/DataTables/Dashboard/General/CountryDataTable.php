<?php
namespace App\DataTables\Dashboard\General;
use App\Models\Country;
use App\DataTables\Base\BaseDataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class CountryDataTable extends BaseDataTable {
    public function __construct(DataTableRequest $request) {
        parent::__construct(new Country());
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($row) {
                return view('dashboard.general.countries.btn.actions', compact('row'));
            })
            ->editColumn('status', function (Country $country) {
                return $this->StatusChange($country->status,$country->status());
            })
        ->rawColumns(['action','created_at', 'updated_at', 'status']);
    }

    public function query(): QueryBuilder{

        return Country::with('states');
    }

    protected function getColumns(): array {
        return [
            ['name'=>'id','data'=>'id','title'=>'#','orderable'=>false,'searchable'=>false,],
            ['name'=>'name','data'=>'name','title'=> 'Name',],
            ['name'=>'status','data'=> 'status','title'=> 'Status',],
            ['name'=>'action','data'=> 'action','title'=>'Actions','exportable'=>false,'printable'=>false,'orderable'=>false,'searchable'=>false,],
        ];
    }
}