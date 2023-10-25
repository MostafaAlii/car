<?php
namespace App\DataTables\Dashboard\General;
use App\Models\Discount;
use App\DataTables\Base\BaseDataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class DiscountDataTable extends BaseDataTable {
    public function __construct(DataTableRequest $request) {
        parent::__construct(new Discount());
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($discount) {
                return view('dashboard.general.discount.btn.actions', compact('discount'));
            })
            ->editColumn('status', function (Discount $discount) {
                return $this->StatusChange($discount->status,$discount->status());
            })
        ->rawColumns(['action','created_at', 'updated_at', 'status']);
    }

    public function query(): QueryBuilder{

        return Discount::query();
    }

    protected function getColumns(): array {
        return [
            ['name'=>'id','data'=>'id','title'=>'#','orderable'=>false,'searchable'=>false,],
            ['name'=>'code','data'=>'code','title'=> 'Code',],
            ['name'=>'type','data'=>'type','title'=> 'Type',],
            ['name'=>'start_data','data'=>'start_data','title'=> 'Start Date',],
            ['name'=>'end_data','data'=>'end_data','title'=> 'End Date',],
            ['name'=>'use_coupon','data'=>'use_coupon','title'=> 'Use Coupon',],
            ['name'=>'used_coupon','data'=>'used_coupon','title'=> 'Used Coupon',],
            ['name'=>'value','data'=>'value','title'=> 'Value',],
            ['name'=>'couponsUsed','data'=>'couponsUsed','title'=> 'Coupons Used',],
            ['name'=>'status','data'=> 'status','title'=> 'Status',],
            ['name'=>'action','data'=> 'action','title'=>'Actions','exportable'=>false,'printable'=>false,'orderable'=>false,'searchable'=>false,],
        ];
    }
}