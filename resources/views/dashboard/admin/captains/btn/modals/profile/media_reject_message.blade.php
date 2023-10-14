<div class="modal fade" id="rejectModal{{ $status->id }}" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectModalLabel">{{ $status?->name_photo }} Reject Reason</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="updateStatusForm" method="post" action="{{ route('captains.updateStatus', $status->id) }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="captain_profile_id" value="{{ $data['captain']->profile->id }}">
                    <input type="hidden" name="name_photo" value="{{ $status->name_photo }}">
                    <input type="hidden" name="status" value="reject">
                    <textarea id="rejectReason" name="reject_message" class="form-control" rows="4" placeholder="Enter reject reason"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Submit</button> <!-- زر لتحديث الحالة إلى reject -->
                </div>
            </form>
        </div>
    </div>
</div>
