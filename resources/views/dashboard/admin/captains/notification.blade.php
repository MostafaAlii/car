<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">send Notification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('captains.sendNotificationAll')}}" method="post">
                    @csrf

                    <input type="hidden" name="type" value="all_drivers">

                    <div class="row">
                        <div class="col">
                            <label>Title Notification</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <label>body Notification</label>
                            <input type="text" class="form-control" name="body" required>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
