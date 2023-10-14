<div class="modal fade" id="delete{{$agent->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('general.delete') .' '. $agent->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('agents.destroy', $agent->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    
                    <div class="alert alert-danger">
                        <h4 class="text-center">Are You Sure ? to delete <span class="text-danger">{{$agent->name}}</span></h4>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('general.close')
                            }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('general.delete') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>