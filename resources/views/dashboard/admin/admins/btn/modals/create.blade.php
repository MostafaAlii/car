<div class="modal fade" id="create{{ $title }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('general.create') .' '. $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admins.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
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
                        <label for="name">{{ trans('admins.name') }}</label>
                        <input type="text" class="form-control" required name="name" id="name" value="">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- End Name -->

                    <!-- Start Email -->
                    <div class="form-group">
                        <label for="email">{{ trans('admins.email') }}</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- End Email -->

                    <!-- Start Phone -->
                    <div class="form-group">
                        <label for="phone">{{ trans('admins.phone') }}</label>
                        <input type="number" class="form-control" required name="phone" id="phone">
                        @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- End Phone -->

                    <!-- Start Status Status -->
                    <div class="form-group p-1">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option selected disabled>Select {{$title}} Status...</option>
                            <option value="active" {{ old('status')=='active' ? 'selected' : '' }}>{{ trans('general.active') }}</option>
                            <option value="inactive" {{ old('status')=='inactive' ?'selected' : '' }}>{{ trans('general.inactive') }}</option>
                        </select>
                        @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- End Status Selected -->

                    <!-- Start Password -->
                    <div class="form-group p-1">
                        <label for="password">{{ trans('admins.password') }}</label>
                        <input type="password" class="form-control" required name="password" id="password">
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- End Password -->


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('general.close') }}</button>
                        <button type="submit" class="btn btn-success">{{ trans('general.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>