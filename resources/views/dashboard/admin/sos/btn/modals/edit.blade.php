<div class="modal fade" id="edit{{ $sos->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('general.edit') .' '. $sos->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('sos.update', $sos->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Start Name -->
                    <div class="form-group">
                        <label for="name">{{ trans('agents.name') }}</label>
                        <input type="text" class="form-control" required name="name" id="name" value="{{$sos->name}}">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- End Name -->

                    <!-- Start Phone -->
                    <div class="form-group">
                        <label for="number">{{ trans('agents.phone') }}</label>
                        <input type="number" class="form-control" required name="number" id="number"
                            value="{{$sos->number}}">
                        @error('number')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- End Phone -->
                    <!-- Start Status Status -->
                    <div class="p-1 form-group">
                        <label for="status">Status</label>
                        <select name="status" class="p-1 form-control">
                            <option selected disabled>Select <span class="text-primary">{{$sos->name}}</span>
                                Status...</option>
                            <option value="active" {{ (old('status', $sos->status) == 'active') ? 'selected' : '' }}>
                                {{ trans('general.active') }}
                            </option>
                            <option value="inactive" {{ (old('status', $sos->status) == 'inactive') ? 'selected' : ''
                                }}>
                                {{ trans('general.inactive') }}
                            </option>
                        </select>
                        @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- End Status Selected -->

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