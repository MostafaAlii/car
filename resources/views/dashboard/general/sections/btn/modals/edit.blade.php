<div class="modal fade" id="edit{{ $section->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('general.edit') .' '. $section->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('sections.update', $section->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Start Name -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{$section->name}}">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- End Name -->

                    <div class="p-1 form-group">
                        <!-- Start Country Selected -->
                        <label for="status">Country</label>
                        <select name="country_id" class="p-1 form-control">
                            <option selected disabled>Select <span class="text-primary">{{$section->name}}</span> Country...</option>
                            @foreach(Country::active() as $country)
                            <option value="{{$country->id}}" {{ (old('country_id', $section->country_id) == $country->id) ? 'selected' : '' }}>
                                {{$country->name}}
                            </option>
                            @endforeach
                        </select>
                        <!-- End Country Selected -->
                    </div>
                    <!-- Start Status Status -->
                    <div class="p-1 form-group">
                        <label for="status">Status</label>
                        <select name="status" class="p-1 form-control">
                            <option selected disabled>Select <span class="text-primary">{{$section->name}}</span>
                                Status...</option>
                            <option value="active" {{ (old('status', $section->status) == 'active') ? 'selected' : '' }}>
                                {{ trans('general.active') }}
                            </option>
                            <option value="inactive" {{ (old('status', $section->status) == 'inactive') ? 'selected' : ''
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