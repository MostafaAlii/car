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
                                <div class="col-12 d-flex justify-content-center mt-3">
                                    <!-- Start Personal Media Upload -->
                                    <div class="col-xl-12 md-mt-30 mb-30">
                                        <div class="card card-statistics mb-30">
                                            <div class="card-body">
                                                <h5 class="card-title">Personal Media</h5>
                                                <form method="POST" action="{{ route('captains.uploadMedia') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="imageable_id" value="{{ $data['captain'] }}">
                                                    <input type="hidden" name="type" value="personal">
                                                    <div class="row p-1">
                                                        <div class="col-6">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" name="personal_avatar" id="personal_avatar" />
                                                                <label class="custom-file-label" for="personal_avatar">Choose Presonal Avatar Image</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" name="id_photo_front" id="id_photo_front" />
                                                                <label class="custom-file-label" for="id_photo_front">Choose ID Front Side Image</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row p-1">
                                                        <div class="col-6">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" name="id_photo_back" id="id_photo_back" />
                                                                <label class="custom-file-label" for="id_photo_back">Choose ID Back Side Image Image</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" name="criminal_record" id="criminal_record" />
                                                                <label class="custom-file-label" for="criminal_record">Choose Criminal Record Image</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row p-1">
                                                        <div class="col-6">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" name="captain_license_front" id="captain_license_front" />
                                                                <label class="custom-file-label" for="captain_license_front">Choose Captain License Front Image</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" name="captain_license_back" id="captain_license_back" />
                                                                <label class="custom-file-label" for="captain_license_back">Choose Captain License Back Image</label>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <button type="submit" class="btn btn-success center">Upload</button>
                                                </form>
                                                <br>
                                                <!-- Start Personal Media Table -->
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Image</th>
                                                            <th>Image Name</th>
                                                            <th>Type</th>
                                                            <th>Status</th>
                                                            <th>ِActions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    
                                                        @forelse ($data['captain']['images'] as $image)
                                                        <tr>
                                                            <td>
                                                                @php
                                                                    $imagePath = asset('dashboard/img/' . str_replace(' ', '_', $data['captain']->name) . '_' . $data['captain']->profile->uuid . '/' . $image->type . '/' . $image->filename)
                                                                @endphp
                                                                <img src="{{ $imagePath }}" alt="{{ $image->photo_type }}" width="100">
                                                                <td>{{ ucfirst(str_replace('_', ' ', $image->photo_type)) }}</td>
                                                                <td>{{ $image->type }}</td>
                                                                <td>{{ ucfirst(str_replace('_', ' ', $image->photo_status)) }}</td>
                                                                <td>
                                                                    <div class="mb-1 btn-group">
                                                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ trans('general.processes') }}</button>
                                                                        <div class="dropdown-menu">
                                                                            {{--<a type="button" class="modal-effect btn btn-sm btn-primary dropdown-item" style="text-align: center !important"
                                                                                data-toggle="modal" data-target="#edit{{$image->id}}" data-effect="effect-scale">
                                                                                <span class="icon text-primary text-bold">
                                                                                    <i class="fa fa-edit"></i>
                                                                                    Edit
                                                                                </span>
                                                                            </a>--}}
                                                                            <a type="button" class="modal-effect btn btn-sm btn-success dropdown-item" style="text-align: center !important"
                                                                                data-toggle="modal" data-target="#active{{$image->id}}" data-effect="effect-scale">
                                                                                <span class="icon text-success text-bold">
                                                                                    <i class="fa fa-edit"></i>
                                                                                    Active
                                                                                </span>
                                                                            </a>
                                                                            <a type="button" class="modal-effect btn btn-sm btn-warning dropdown-item" style="text-align: center !important"
                                                                                data-toggle="modal" data-target="#reject{{$image->id}}" data-effect="effect-scale">
                                                                                <span class="icon text-warning text-bold">
                                                                                    <i class="fa fa-edit"></i>
                                                                                    Reject
                                                                                </span>
                                                                            </a>
                                                                            {{--<a type="button" class="modal-effect btn btn-sm btn-danger dropdown-item" style="text-align: center !important"
                                                                                data-toggle="modal" data-target="#delete{{$image->id}}" data-effect="effect-scale">
                                                                                <span class="icon text-danger text-bold">
                                                                                    <i class="fa fa-edit"></i>
                                                                                    Delete
                                                                                </span>
                                                                            </a>--}}
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </td>
                                                        </tr>
                                                        @if ($image->photo_status === 'rejected')
                                                        <tr>
                                                            <td colspan="5">
                                                                <div>
                                                                    <strong class="text-danger">Reject Reason:</strong>
                                                                    {{ $image->reject_reson }}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endif
                                                        @include('dashboard.admin.captains.btn.modals.profile.active')
                                                        @include('dashboard.admin.captains.btn.modals.profile.reject')
                                                        @empty

                                                        @endforelse
                                                    </tbody>
                                                </table>
                                                <!-- Start Personal Media Table -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Personal Media Upload -->
                                        
                                </div>
                                <!-- End Alert Div -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
