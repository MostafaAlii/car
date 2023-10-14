<div class="modal fade" id="create{{ $data['title'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('general.create') .' '. $data['title'] }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('sos.store')}}" method="POST">
                    @csrf
                    <!-- Start Name -->
                    <div class="form-group">
                        <label for="name">{{ trans('agents.name') }}</label>
                        <input type="text" class="form-control" required name="name" id="name" value="">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- End Name -->

                    <!-- Start Phone -->
                    <div class="form-group">
                        <label for="phone">Number</label>
                        <input type="number" class="form-control" required name="number" id="number">
                        @error('number')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- End Phone -->

                    <!-- Start Status Status -->
                    <div class="p-1 form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option selected disabled>Select {{$data['title']}} Status...</option>
                            <option value="active" {{ old('status')=='active' ? 'selected' : '' }}>{{
                                trans('general.active') }}</option>
                            <option value="inactive" {{ old('status')=='inactive' ?'selected' : '' }}>{{
                                trans('general.inactive') }}</option>
                        </select>
                        @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- End Status Selected -->


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('general.close')
                            }}</button>
                        <button type="submit" class="btn btn-success">{{ trans('general.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>