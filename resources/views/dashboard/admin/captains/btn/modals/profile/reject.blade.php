<div class="modal fade" id="reject{{ $image->id }}" tabindex="-1" role="dialog" aria-labelledby="carRejectModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="carRejectModalLabel">{{ ucfirst(str_replace('_', ' ', $image->photo_type)) }} Reject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('captains.updateMediaStatus', $image->id) }}">
                @csrf
                <input type="hidden" name="photo_status" value="rejected">
                 <input type="hidden" name="imageable_id" value="{{ $data['captain']->profile->captain_id }}">
                <div class="modal-body mx-auto" style="display: flex; align-items: center; flex-direction: column;">
                    Are You Sure To Reject this <span class="text-warning">{{ ucfirst(str_replace('_', ' ', $image->photo_type)) }}</span> Photo
                    <div class="row">
                        <div class="col-md-12 col-md-offset-3">
                            <img class="object-fit-cover border rounded" width="400px" height="200px" src="{{asset('dashboard/img/' . str_replace(' ', '_', $data['captain']->name) . '_' . $data['captain']->profile->uuid . '/' . $image->type . '/' . $image->filename)}}" alt="">
                            <br>
                            <textarea name="reject_reson" class="form-control col-xs-12" rows="5" placeholder="Enter reject reason"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Rejected</button>
                </div>
            </form>
        </div>
    </div>
</div>