<div class="tab-pane fade active show" id="profile-03" role="tabpanel" aria-labelledby="profile-03-tab">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="shadow accordion plus-icon">
                    <div class="acd-group">
                        <a href="#" class="acd-heading">Personal Information</a>
                        <div class="acd-des">
                            <div>
                                <p class="mb-0">Name: {{$data['captain']?->name}}</p>
                                <p class="mb-0">Email: {{$data['captain']?->email}}</p>
                                <p class="mb-0">Status: {{$data['captain']?->status}}</p>
                                <p class="mb-0">Gender: {{$data['captain']?->gender}}</p>
                                <p class="mb-0">Phone: {{$data['captain']?->phone}}</p>
                                <p class="mb-0">Personal ID: <span class="text-success">{{$data['captain']?->profile?->number_personal}}</span></p>
                                <p class="mb-0">Added By:
                                    @if ($data['captain']?->admin_id !== null)
                                        <span class="text-primary">(Admin)</span> {{ $data['captain']->admin->name }}
                                    @endif
                                    @if ($data['captain']?->agent_id !== null)
                                        <span class="text-green-500">(Agent)</span> {{ $data['captain']->agent->name }}
                                    @endif
                                    @if ($data['captain']?->employee_id !== null)
                                        <span class="text-purple-500">(Employee)</span> {{ $data['captain']->employee->name }}
                                    @endif
                                </p>
                                <p class="mb-0">From: {{$data['captain']?->country->name}}</p>
                                <!-- Start Alert Div -->
                                <div class="col-12 d-flex justify-content-center">
                                    
                                    <form method="POST" action="{{ route('captains.uploadMedia') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="imageable_id" value="{{ $data['captain'] }}">
                                        <div class="form-group">
                                            <label for="personal_avatar">Personal Avatar</label>
                                            <input type="file" name="personal_avatar" class="form-control">
                                        </div>
                                    
                                        <div class="form-group">
                                            <label for="id_photo_front">ID Photo Front</label>
                                            <input type="file" name="id_photo_front" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="id_photo_back">ID Photo Back</label>
                                            <input type="file" name="id_photo_back" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="criminal_record">Criminal Record</label>
                                            <input type="file" name="criminal_record" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="captain_license_front">License Front</label>
                                            <input type="file" name="captain_license_front" class="form-control">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="captain_license_back">License Back</label>
                                            <input type="file" name="captain_license_back" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="car_license_front">Car License Front</label>
                                            <input type="file" name="car_license_front" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="car_license_back">Car License Back</label>
                                            <input type="file" name="car_license_back" class="form-control">
                                        </div>
                                    
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </form>
                                        {{--  @php
                                            $emptyFields = collect(['photo_id_before', 'photo_id_behind', 'photo_driving_before', 'photo_driving_behind', 'photo_criminal', 'photo_personal'])->filter(function ($field) use ($data) {
                                                return empty($data['captain']->profile->{$field});
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
                                                    <a data-target="#upload{{$data['captain']->profile->id}}" data-toggle="modal"  data-effect="effect-scale" class="btn btn-success btn-sm" role="button">
                                                        <i class="fa fa-plus"></i>
                                                        Upload
                                                    </a>
                                                </div>

                                            </div>
                                            @include('dashboard.admin.captains.btn.modals.profile.profile_media')
                                        @endif
                                    @endif --}}
                                </div>
                                <!-- End Alert Div -->
                            </div>
                            <!-- Start Personal Media Table -->
                            {{-- <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Image Name</th>
                                        <th>Status</th>
                                        <th>ِActions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data['captain']->profile->profileStatus as $status)
                                        <tr>
                                            <td>
                                                @php
                                                    $imageName = $data['captain']->profile->{$status->name_photo};
                                                    $imagePath = asset('dashboard/img/' .$data['captain']->profile->uuid . '_' . str_replace(' ', '_', $data['captain']->name) . '/' . $status->type_photo . '/' . $imageName)
                                                @endphp
                                                <img src="{{ $imagePath }}" alt="{{ $status->name_photo }}" width="100">
                                            </td>
                                            <td>{{ ucfirst(str_replace('_', ' ', $status->name_photo)) }}</td>
                                            <td>{{ $status->status }}</td>
                                            <td>
                                                <form id="updateStatusForm" data-id="{{ $status->id }}" method="post" action="{{ route('captains.updateStatus', $status->id) }}">
                                                    @csrf
                                                    <input type="hidden" name="captain_id" value="{{ $data['captain']->profile->id }}">
                                                    <input type="hidden" name="field_name" value="{{ $status->name_photo }}">
                                                    <select id="statusSelect"  data-status-id="{{ $status->id }}" class="p-1 form-control statusSelect" name="status">
                                                        <option selected>Choose Status</option>
                                                        <option value="accept" {{ $status->status === 'accept' ? 'selected' : '' }}>Accept</option>
                                                        <option value="not_active" {{ $status->status === 'not_active' ? 'selected' : '' }}>Not Active</option>
                                                        <option value="not_active" {{ $status->status === 'reject' ? 'selected' : '' }}>reject</option>
                                                    </select>
                                                </form>
                                                <form id="rejectForm" class="p-1 col-12 d-flex justify-content-center" method="post" action="{{ route('captains.updateStatus', $status->id) }}">
                                                    @csrf
                                                    <input type="hidden" name="captain_id" value="{{ $data['captain']->profile->id }}">
                                                    <input type="hidden" name="field_name" value="{{ $status->name_photo }}">
                                                    <input type="hidden" name="status" value="reject">
                                                    <a class="p-1 btn btn-lg btn-danger" data-toggle="modal" data-target="#rejectModal{{$status->id}}">
                                                        <i class="text-white fa fa-times-circle" aria-hidden="true"></i>
                                                    </a>
                                                </form>
                                                @include('dashboard.admin.captains.btn.modals.profile.media_reject_message')
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
                                                No Media Found For {{ $data['captain']->name }}
                                            </span>
                                        </td>
                                    @endforelse
                                </tbody>
                            </table> --}}
                            <!-- End Personal Media Table -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
