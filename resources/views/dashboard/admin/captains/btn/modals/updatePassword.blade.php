<div class="modal fade" id="updatePassword{{ $captain->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('general.edit') .' '. $captain->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('captains.update-password', $captain->id)}}" method="POST">
                    @csrf
                    <div class="p-1 form-group">
                        <label for="password">{{ trans('agents.password') }}</label>
                        <input type="password" class="form-control" name="password" id="password">
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('general.close')
                            }}</button>
                        <button type="submit" class="btn btn-success">{{ trans('general.edit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>