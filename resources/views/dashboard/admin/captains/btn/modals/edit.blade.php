<div class="modal fade" id="edit{{ $captain->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form action="{{route('captains.update', $captain->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Start Avatar -->
                    {{--<div class="form-row">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" name="image" id="image">
                            @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>--}}
                    <!-- End Avatar -->
                    <!-- Start Name -->
                    <div class="form-group">
                        <label for="name">{{ trans('agents.name') }}</label>
                        <input type="text" class="form-control" required name="name" id="name" value="{{$captain->name}}">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- End Name -->

                    <!-- Start Email -->
                    <div class="form-group">
                        <label for="email">{{ trans('agents.email') }}</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                            value="{{$captain->email}}">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- End Email -->

                    <!-- Start Phone -->
                    <div class="form-group">
                        <label for="phone">{{ trans('agents.phone') }}</label>
                        <input type="number" class="form-control" required name="phone" id="phone"
                            value="{{$captain->phone}}">
                        @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- End Phone -->
                    <div class="p-1 form-group">
                        <!-- Start Country Selected -->
                        <label for="status">Country</label>
                        <select name="country_id" class="p-1 form-control">
                            <option selected disabled>Select <span class="text-primary">{{$captain->name}}</span> Country...</option>
                            @foreach(Country::active() as $country)
                            <option value="{{$country->id}}" {{ (old('country_id', $captain->country_id) == $country->id) ? 'selected' : '' }}>
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
                            <option selected disabled>Select <span class="text-primary">{{$captain->name}}</span>
                                Status...</option>
                            <option value="active" {{ (old('status', $captain->status) == 'active') ? 'selected' : '' }}>
                                {{ trans('general.active') }}
                            </option>
                            <option value="inactive" {{ (old('status', $captain->status) == 'inactive') ? 'selected' : ''
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