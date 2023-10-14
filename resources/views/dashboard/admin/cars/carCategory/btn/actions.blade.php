<div class="mb-1 btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ trans('general.processes') }}</button>
    <div class="dropdown-menu">
        <button type="button" class="modal-effect btn btn-sm btn-primary dropdown-item" style="text-align: center !important"
            data-toggle="modal" data-target="#edit{{$carCategory->id}}" data-effect="effect-scale">
            <span class="icon text-primary text-bold">
                <i class="fa fa-edit"></i>
                {{ trans('general.edit') }}
            </span>
        </button>

        <button type="button" class="modal-effect btn btn-sm btn-primary dropdown-item" style="text-align: center !important"
            data-toggle="modal" data-target="#updateStatus{{$carCategory->id}}" data-effect="effect-scale">
            <span class="icon text-dark text-bold">
                <i class="fa fa-edit"></i>
                Update Status
            </span>
        </button>
        
        <button type="button" class="modal-effect btn btn-sm btn-danger dropdown-item" style="text-align: center !important" data-toggle="modal" data-target="#delete{{$carCategory->id}}" data-effect="effect-scale">
            <span class="icon text-danger text-bold">
                <i class="fa fa-trash"></i>
                {{ trans('general.delete') }}
            </span>
        </button>
    </div>
</div>


@include('dashboard.admin.cars.carCategory.btn.modals.edit')
@include('dashboard.admin.cars.carCategory.btn.modals.updateStatus')
@include('dashboard.admin.cars.carCategory.btn.modals.destroy')