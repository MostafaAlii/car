<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#changeStatus{{$row->id}}"><i class="fa fa-edit"></i></button>

<!-- Modal -->
<div class="modal fade" id="changeStatus{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Status : {{$row->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('state.changeStatusState', $row->id)}}" method="post">
                    @csrf

                    <input type="hidden" name="id" value="{{$row->id}}">

                    <div class="row">
                        <div class="col">
                            <label>Are you sure the situation has changed?</label>
                           <select class="form-control p-1" name="status">
                               <option value="1" {{$row->status == 1 ? 'selected' : null}}> Active</option>
                               <option value="0" {{$row->status == 0 ? 'selected' : null}}> No Active</option>
                           </select>
                        </div>
                    </div>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>