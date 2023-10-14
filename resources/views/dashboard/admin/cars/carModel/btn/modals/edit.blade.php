<div class="modal fade" id="edit{{ $carModel->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('general.edit') .' '. $carModel->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('carModel.update', $carModel->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Start Name -->
                    <div class="form-group">
                        <label for="name">{{ trans('agents.name') }}</label>
                        <input type="text" class="form-control" required name="name" id="name" value="{{$carModel->name}}">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- End Name -->
                    <!-- Start Status Status -->
                    <div class="p-1 form-group">
                        <label for="status">Status</label>
                        <select name="status" class="p-1 form-control">
                            <option selected disabled>Select <span class="text-primary">{{$carModel->name}}</span>
                                Status...</option>
                            <option value="1" {{ (old('status', $carModel->status) == '1') ? 'selected' : '' }}>
                                {{ trans('general.active') }}
                            </option>
                            <option value="0" {{ (old('status', $carModel->status) == '0') ? 'selected' : ''
                                }}>
                                {{ trans('general.inactive') }}
                            </option>
                        </select>
                        @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- End Status Selected -->
                    <!-- End Phone -->
                    <div class="p-1 form-group">
                        <!-- Start Country Selected -->
                        <label for="status">Car Make</label>
                        <select name="car_make_id" class="p-1 form-control">
                            <option selected disabled>Select <span class="text-primary">{{$carModel->name}}</span> Car Make...</option>
                            @foreach(CarMake::active() as $car_make)
                            <option value="{{$car_make->id}}" {{ (old('car_make_id', $carModel->car_make_id) == $car_make->id) ? 'selected' : '' }}>
                                {{$car_make->name}}
                            </option>
                            @endforeach
                        </select>
                        <!-- End Country Selected -->
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