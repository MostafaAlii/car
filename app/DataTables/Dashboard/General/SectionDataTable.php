<?php
namespace App\DataTables\Dashboard\General;
use App\Models\Section;
use App\DataTables\Base\BaseDataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class SectionDataTable extends BaseDataTable {
    public function __construct(DataTableRequest $request) {
        parent::__construct(new Section());
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Section $section) {
                return view('dashboard.general.sections.btn.actions', compact('section'));
            })
            ->editColumn('created_at', function (Section $section) {
                return $this->formatBadge($this->formatDate($section->created_at));
            })
            ->editColumn('updated_at', function (Section $section) {
                return $this->formatBadge($this->formatDate($section->updated_at));
            })
            ->editColumn('status', function (Section $section) {
                return $this->StatusChange($section->status);
            })
            ->editColumn('admin_id', function (Section $section) {
                return $section?->admin?->name;
            })
            ->editColumn('agent_id', function (Section $section) {
                return $section?->agent?->name;
            })
            ->editColumn('country_id', function (Section $section) {
                return $section?->country?->name;
            })
            ->rawColumns(['action', 'created_at', 'updated_at','status', 'admin_id', 'agent_id', 'country_id']); 
    }

    public function query(): QueryBuilder {
        return Section::latest();
    }

    public function getColumns(): array {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#', 'orderable' => false, 'searchable' => false,],
            ['name' => 'name', 'data' => 'name', 'title' => 'Name',],
            ['name' => 'admin_id', 'data' => 'admin_id', 'title' => 'Admin',],
            ['name' => 'agent_id', 'data' => 'agent_id', 'title' => 'Agent',],
            ['name' => 'country_id', 'data' => 'country_id', 'title' => 'Country',],
            ['name' => 'status', 'data' => 'status', 'title' => 'Status',],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => 'Created_at', 'orderable' => false, 'searchable' => false,],
            ['name' => 'action', 'data' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false,],
        ];
    }
}