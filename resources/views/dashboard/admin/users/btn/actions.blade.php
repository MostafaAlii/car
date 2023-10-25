<div class="mb-1 btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ trans('general.processes') }}</button>
    <div class="dropdown-menu">
        <a href="{{ route('users.show', $admin->profile->uuid) }}" class="modal-effect btn btn-sm btn-dark dropdown-item" style="text-align: center !important">
            <span class="icon text-info text-dark">
                <i class="fa fa-edit"></i>
                Profile
            </span>
        </a>
        <button type="button" class="modal-effect btn btn-sm btn-primary dropdown-item" style="text-align: center !important"
            data-toggle="modal" data-target="#edit{{$admin->id}}" data-effect="effect-scale">
            <span class="icon text-primary text-bold">
                <i class="fa fa-edit"></i>
                {{ trans('general.edit') }}
            </span>
        </button>
        <button type="button" class="modal-effect btn btn-sm btn-primary dropdown-item" style="text-align: center !important"
            data-toggle="modal" data-target="#updatePassword{{$admin->id}}" data-effect="effect-scale">
            <span class="icon text-dark text-bold">
                <i class="fa fa-edit"></i>
                Update Password
            </span>
        </button>
        <button type="button" class="modal-effect btn btn-sm btn-danger dropdown-item" style="text-align: center !important" data-toggle="modal" data-target="#delete{{$admin->id}}" data-effect="effect-scale">
            <span class="icon text-danger text-bold">
                <i class="fa fa-trash"></i>
                {{ trans('general.delete') }}
            </span>
        </button>

        <button type="button" class="modal-effect btn btn-sm btn-danger dropdown-item" style="text-align: center !important" data-toggle="modal" data-target="#Notification{{$admin->id}}" data-effect="effect-scale">
            <span class="icon text-info text-bold">
                <i class="fa fa-bell"></i>
                {{ trans('general.Notification') }}
            </span>
        </button>
        <a href="{{route('users.getOrders',['client_orders' => $admin->id])}}" class="modal-effect btn btn-sm btn-dark dropdown-item" style="text-align: center !important">
            <span class="icon text-info text-dark">
                <i class="fa fa-edit"></i>
                My Trips
            </span>
        </a>
    </div>
</div>


@include('dashboard.admin.users.btn.modals.edit')
@include('dashboard.admin.users.btn.modals.updatePassword')
@include('dashboard.admin.users.btn.modals.destroy')
@include('dashboard.admin.users.btn.modals.notifications')
