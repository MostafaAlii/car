<div class="tab-pane fade" id="cars-04" role="tabpanel" aria-labelledby="cars-04-tab">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="shadow accordion plus-icon">
                    <div class="acd-group">
                        <a href="#" class="acd-heading">My Car</a>
                        <div class="acd-des">
                            <div>
                                <p class="mb-0">Car Make: {{$data['captain']->car->car_make->name ?? null}}</p>
                                <p class="mb-0">Car Model: {{$data['captain']->car->car_model->name ?? null}}</p>
                                <p class="mb-0">Car Type: {{$data['captain']->car->car_type->name ?? null}}</p>
                                <p class="mb-0">Car Category: {{$data['captain']->car->category_car->name ?? null}}</p>
                                <hr>
                                <!-- Start Alert Div -->
                                <div class="col-12 d-flex justify-content-center">
                                    @if ($data['captain']->car)
                                        @php
                                            $emptyFields = collect(['car_photo_before', 'car_photo_behind', 'car_photo_right', 'car_photo_north', 'car_photo_inside', 'car_license_before', 'car_license_behind'])->filter(function ($field) use ($data) {
                                            return empty($data['captain']->car->{$field});
                                            });
                                        @endphp
                                        @if ($emptyFields->isNotEmpty())
                                        <div class="col-8 alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Important!</strong>
                                            <!-- Upload Image -->
                                            <div>
                                                @foreach ($emptyFields as $field)
                                                <p class="mb-0">{{ ucfirst(str_replace('_', ' ', $field)) }} Image is requrie.</p>
                                                @endforeach
                                            </div>
                                            <div class="p-1 col-12 d-flex justify-content-center">
                                                <a data-target="#uploadCar{{$data['captain']->car->id}}" data-toggle="modal" data-effect="effect-scale"
                                                    class="btn btn-success btn-sm" role="button">
                                                    <i class="fa fa-plus"></i>
                                                    Upload
                                                </a>
                                            </div>

                                        </div>
                                            @include('dashboard.admin.captains.btn.modals.profile.cars_media')
                                        @endif
                                    @endif
                                </div>
                                <!-- End Alert Div -->
                            </div>
                            <!-- Start Car Media Table -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Image Name</th>
                                        <th>Status</th>
                                        <th>ِActions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data['captain']->car->carsStatus as $status)
                                    <tr>
                                        <td>
                                            @php
                                            $imageName = $data['captain']->car->{$status->name_photo};
                                            $imagePath = asset('dashboard/img/' .$data['captain']->profile->uuid . '_' . str_replace(' ', '_', $data['captain']->name) .
                                            '/' . $status->type_photo . '/' . $imageName)
                                            @endphp
                                            <img src="{{ $imagePath }}" alt="{{ $status->name_photo }}" width="100">
                                        </td>
                                        <td>{{ ucfirst(str_replace('_', ' ', $status->name_photo)) }}</td>
                                        <td>{{ $status->status }}</td>
                                        <td>
                                            <form id="updateStatusForm" data-id="{{ $status->id }}" method="post"
                                                action="{{ route('captains.updateCarStatus', $status->id) }}">
                                                @csrf
                                                <input type="hidden" name="captain_id" value="{{ $data['captain']->car->id }}">
                                                <input type="hidden" name="field_name" value="{{ $status->name_photo }}">
                                                <select id="statusSelect" data-status-id="{{ $status->id }}" class="p-1 form-control statusSelect"
                                                    name="status">
                                                    <option selected>Choose Status</option>
                                                    <option value="accept" {{ $status->status === 'accept' ? 'selected' : '' }}>Accept</option>
                                                    <option value="not_active" {{ $status->status === 'not_active' ? 'selected' : '' }}>Not Active
                                                    </option>
                                                </select>
                                            </form>
                                            <form id="rejectForm" class="p-1 col-12 d-flex justify-content-center" method="post"
                                                action="{{ route('captains.updateCarStatus', $status->id) }}">
                                                @csrf
                                                <input type="hidden" name="captain_profile_uuid" value="{{ $data['captain']->profile->uuid}}">
                                                <input type="hidden" name="captain_name" value="{{ $data['captain']->name}}">
                                                <input type="hidden" name="captain_id" value="{{ $data['captain']->car->id }}">
                                                <input type="hidden" name="field_name" value="{{ $status->name_photo }}">
                                                <input type="hidden" name="status" value="reject">
                                                <a class="p-1 btn btn-lg btn-danger" data-toggle="modal" data-target="#carRejectModal{{$status->id}}">
                                                    <i class="text-white fa fa-times-circle" aria-hidden="true"></i>
                                                </a>
                                            </form>
                                            @include('dashboard.admin.captains.btn.modals.profile.car_media_reject_message')
                                        </td>
                                        @if ($status->status === 'reject')
                                        <td>
                                            Reject Reason: {!! $status->reject_message !!}
                                        </td>
                                        @endif
                                    </tr>
                                    @empty

                                    <td colspan="4">
                                        <span class="col-12 d-flex justify-content-center text-danger">
                                            No Car Media Found For {{ $data['captain']->name }}
                                        </span>
                                    </td>
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- End Car Media Table -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
