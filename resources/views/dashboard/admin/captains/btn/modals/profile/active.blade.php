<div class="modal fade" id="active{{ $image->id }}" tabindex="-1" role="dialog" aria-labelledby="carRejectModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="carRejectModalLabel">{{ ucfirst(str_replace('_', ' ', $image->photo_type)) }} Active</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('captains.updateMediaStatus', $image->id) }}">
                @csrf
                <input type="hidden" name="photo_status" value="accept">
                <input type="hidden" name="imageable_id" value="{{ $data['captain']->profile->captain_id }}">
                <div class="modal-body mx-auto" style="display: flex; align-items: center; flex-direction: column;">
                    Are You Sure To Active this <span class="text-success">{{ ucfirst(str_replace('_', ' ', $image->photo_type)) }}</span> Photo
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <img class="object-fit-cover border rounded" width="400px" height="200px" src="{{asset('dashboard/img/' . str_replace(' ', '_', $data['captain']->name) . '_' . $data['captain']->profile->uuid . '/' . $image->type . '/' . $image->filename)}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Active</button>
                </div>
            </form>
        </div>
    </div>
</div>