<div class="mb-1 btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ trans('general.processes') }}</button>
    <div class="dropdown-menu">
        <a href="{{ route('captains.show', $captain->profile->uuid) }}" class="modal-effect btn btn-sm btn-dark dropdown-item" style="text-align: center !important">
            <span class="icon text-info text-dark">
                <i class="fa fa-edit"></i>
                Profile
            </span>
        </a>
        <button type="button" class="modal-effect btn btn-sm btn-primary dropdown-item" style="text-align: center !important"
            data-toggle="modal" data-target="#edit{{$captain->id}}" data-effect="effect-scale">
            <span class="icon text-primary text-bold">
                <i class="fa fa-edit"></i>
                {{ trans('general.edit') }}
            </span>
        </button>

        <button type="button" class="modal-effect btn btn-sm btn-primary dropdown-item" style="text-align: center !important"
            data-toggle="modal" data-target="#updatePassword{{$captain->id}}" data-effect="effect-scale">
            <span class="icon text-dark text-bold">
                <i class="fa fa-edit"></i>
                Update Password
            </span>
        </button>

        <button type="button" class="modal-effect btn btn-sm btn-danger dropdown-item" style="text-align: center !important" data-toggle="modal" data-target="#delete{{$captain->id}}" data-effect="effect-scale">
            <span class="icon text-danger text-bold">
                <i class="fa fa-trash"></i>
                {{ trans('general.delete') }}
            </span>
        </button>
        <a class="modal-effect btn btn-sm btn-dark dropdown-item" style="text-align: center !important">
            <span class="icon text-info text-dark">
                <i class="fa fa-edit"></i>
                Notifictation
            </span>
        </a>
        <button type="button" class="modal-effect btn btn-sm btn-dark dropdown-item" style="text-align: center !important" data-toggle="modal" data-target="#SendNotification{{$captain->id}}" data-effect="effect-scale">
            <span class="icon text-info text-bold">
                <i class="fa fa-bell"></i>
                Send Notifictation
            </span>
        </button>
        <a class="modal-effect btn btn-sm btn-dark dropdown-item" style="text-align: center !important">
            <span class="icon text-info text-dark">
                <i class="fa fa-edit"></i>
                Documents
            </span>
        </a>
        <a href="{{route('captains.getOrders',['caption_orders' => $captain->id])}}" class="modal-effect btn btn-sm btn-dark dropdown-item" style="text-align: center !important">
            <span class="icon text-info text-dark">
                <i class="fa fa-edit"></i>
                My Trips
            </span>
        </a>
    </div>
</div>


@include('dashboard.admin.captains.btn.modals.edit')
@include('dashboard.admin.captains.btn.modals.notifications')
@include('dashboard.admin.captains.btn.modals.updatePassword')
@include('dashboard.admin.captains.btn.modals.destroy')
