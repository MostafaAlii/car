<div class="modal fade" id="notification{{ $captain->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog model-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('general.edit') .' '. $captain->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('agentCaptains.notifications', $captain->id)}}" method="GET">
                    @csrf
                    <table class="table table-row-dashed table-striped table-hover table-borderd table-row-gray-300
                    align-middle gs-0 table-row-bordered gy-5">
                        <thead>
                            <tr>
                                <th>Content</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($captain->notifications as $notification)
                                <tr>
                                    <td>{{ $notification->notifications }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-danger" colspan="2">No Notifications Found For {{ $captain->name }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('general.close') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>