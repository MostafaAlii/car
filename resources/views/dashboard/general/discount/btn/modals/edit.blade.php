<div class="modal fade" id="edit{{ $discount->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('general.edit') .' '. $discount->code }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('discounts.update', $discount->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <!-- Start Code -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="text" class="form-control" required name="code" id="code" value="{{$discount->code}}">
                                @error('code')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- End Code -->
                        <!-- Start Type -->
                        <div class="col-6">
                            <div class="p-1 form-group">
                                <label for="type">Type</label>
                                <select name="type" class="form-control p-1">
                                    <option selected disabled>Select {{$discount->code}} Type...</option>
                                    <option value="fixed" {{ old('type')== "fixed" ? 'selected' : '' }}>Fixed</option>
                                    <option value="cash" {{ old('type')== "cash" ?'selected' : '' }}>Cash</option>
                                </select>
                                @error('type')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>
                        <!-- End Type -->
                    </div>
                    
                    <div class="row">
                        <div class="col-6">
                            <label>Start Date :</label>
                            <input type="datetime-local" name="start_data" class="form-control" value="{{ $discount->start_data }}">
                            @error('start_data')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label>End Date :</label>
                            <input type="datetime-local" name="end_data" class="form-control" value="{{ $discount->start_data }}">
                            @error('end_data')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <div class="p-1 form-group">
                                <label for="use_coupon">Use Coupoun Limit</label>
                                <input type="number" class="form-control" required name="use_coupon" id="use_coupon" value="{{$discount->use_coupon}}">
                                @error('use_coupon')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4 p-1">
                            <div class=" form-group">
                                <label for="value">Coupoun Value</label>
                                <input type="number" class="form-control" required name="value" id="value" value="{{$discount->value}}">
                                @error('value')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control p-1">
                                    <option selected disabled>Select {{$discount->code}} Status...</option>
                                    <option value="1" {{ old('status')== 1 ? 'selected' : '' }}>{{
                                        trans('general.active') }}</option>
                                    <option value="0" {{ old('status')== 0 ?'selected' : '' }}>{{
                                        trans('general.inactive') }}</option>
                                </select>
                                @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>



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