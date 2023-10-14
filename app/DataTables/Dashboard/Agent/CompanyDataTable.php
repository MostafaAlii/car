<?php
namespace App\DataTables\Dashboard\Agent;
use App\Models\Company;
use App\DataTables\Base\BaseDataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class CompanyDataTable extends BaseDataTable {
    public function __construct(DataTableRequest $request) {
        parent::__construct(new Company());
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Company $company) {
                return view('dashboard.agent.companies.btn.actions', compact('company'));
            })
            ->editColumn('created_at', function (Company $company) {
                return $this->formatBadge($this->formatDate($company->created_at));
            })
            ->editColumn('updated_at', function (Company $company) {
                return $this->formatBadge($this->formatDate($company->updated_at));
            })
            ->editColumn('status', function (Company $company) {
                return $this->formatStatus($company->status);
            })
            ->editColumn('country_id', function (Company $company) {
                return $company->country->name;
            })
            ->rawColumns(['action', 'created_at', 'updated_at','status', 'country_id']); 
    }

    public function query(): QueryBuilder {
        return Company::query()->whereCountryId(get_user_data()->country_id);
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