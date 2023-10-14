@extends('layouts.master')
@section('css')
<style>
    .ck-editor__editable_inline {
    min-height: 200px;
}
.acd-des-flex {
    display: flex;
    align-items: center;
    gap: 10px;
}
</style>
@section('title')
{{$title}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{$title}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">Dasboard</a></li>
                <li class="breadcrumb-item active">{{$title}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
@include('layouts.common.partials.messages')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <br><br>
                <!-- Start Content -->
                <form id="mainSettings" action="{{route('mainSettings.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Start Tabs -->
                    <div class="tab round shadow">
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li class="nav-item">
                                    <a class="nav-link @if(app()->getLocale() == $localeCode) active show @endif" id="{{$localeCode}}-tab" data-toggle="tab" href="#{{$localeCode}}" role="tab" aria-controls="{{$localeCode}}" aria-selected="true">
                                        <i class="fa fa-globe"></i>
                                        {{ $properties['native'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <!-- Start Language Panel -->
                                <div class="tab-pane fade @if(app()->getLocale() == $localeCode) active show @endif" id="{{$localeCode}}" role="tabpanel" aria-labelledby="{{$localeCode}}-tab">
                                    <div class="form-group row">
                                        <div class="input-group mb-3 col-md-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">App Name</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="{{'App Name' . ' ' . $properties['native'] }}" value="{{ $setting->translate($localeCode)?->name }}" id="name" name="{{$localeCode}}[name]" aria-label="name" aria-describedby="basic-addon1">
                                        </div>
                                        <div class="input-group mb-3 col-md-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon-author">Author Name</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="{{'Author Name' . ' ' . $properties['native'] }}" id="author" value="{{ $setting->translate($localeCode)?->author }}" name="{{$localeCode}}[author]" aria-label="author" aria-describedby="basic-addon-author">
                                        </div>
                                        <div class="input-group mb-3 col-md-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon-address">Address</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="{{'Address' . ' ' . $properties['native'] }}" id="address" value="{{ $setting->translate($localeCode)?->address }}" name="{{$localeCode}}[address]" aria-label="address" aria-describedby="basic-addon-address">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <labe>{{'Description' . ' ' . $properties['native'] }} </labe>
                                            <textarea class="form-control" id="description" name="{{$localeCode}}[description]" rows="3">{{ $setting?->translate($localeCode)?->description }}</textarea>
                                        </div>

                                        <div class="col-md-6">
                                            <labe>{{'Road Toll For Client' . ' ' . $properties['native'] }} </labe>
                                            <textarea class="form-control" id="road_toll" name="{{$localeCode}}[road_toll]" rows="3">{{ $setting?->translate($localeCode)?->road_toll }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Language Panel -->
                            @endforeach
                        </div>
                    </div>
                    <hr><br>
                    <!-- End Tabs -->
                    <!-- Start First Row -->
                    <hr><br>
                    <div class="form-group row">
                        <!-- Facebook && Instgram Links -->
                        <div class="col-lg-6">
                            <label class="col-form-label" for="facebook">Facebook</label>
                            <input type="text" class="form-control" value="{{ $setting?->facebook }}" id="facebook" name="facebook" placeholder="Facebook" value="{{old('facebook')}}">
                            @error('facebook')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label class="col-form-label" for="instagram">Instagram</label>
                            <input type="text" class="form-control" value="{{ $setting?->instagram }}" id="instagram" name="instagram" placeholder="Instagram" value="{{old('instagram')}}">
                            @error('instagram')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- End Facebook && Instgram Links -->
                    </div>

                    <div class="form-group row">
                        <!-- Email && Phone Number -->
                        <div class="col-lg-4">
                            <label class="col-form-label" for="email">Email</label>
                            <input type="text" value="{{ $setting?->email }}" class="form-control" id="email" name="email" placeholder="Email" value="{{old('email')}}">
                            @error('email')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label class="col-form-label" for="phone">Phone Number</label>
                            <input type="text" value="{{ $setting?->phone }}" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="{{old('phone')}}">
                            @error('phone')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label class="col-form-label" for="phone">Whatsapp</label>
                            <input type="text" value="{{ $setting?->whatsapp }}" class="form-control" id="whatsapp" name="whatsapp" placeholder="Whatsapp Number" value="{{old('whatsapp')}}">
                            @error('whatsapp')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- End Email && Phone Number -->
                    </div>

                    <div class="form-group row">
                        <!-- Start Open Door Price -->
                        <div class="col-lg-3">
                            <label class="col-form-label" for="open_door">Open Door</label>
                            <input type="number" value="{{ $setting?->open_door }}" class="form-control" id="open_door" name="open_door" placeholder="Open Door Price">
                            @error('open_door')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <!-- End Open Door Price -->

                        <!-- Start Waiting Price -->
                        <div class="col-lg-3">
                            <label class="col-form-label" for="open_door">Waiting Price</label>
                            <input type="number" value="{{ $setting?->waiting_price }}" class="form-control" id="waiting_price" name="waiting_price" placeholder="Waiting Price">
                            @error('waiting_price')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <!-- End Waiting Price -->

                        <!-- Start Country Tax -->
                        <div class="col-lg-3">
                            <label class="col-form-label" for="open_door">Country Tax</label>
                            <input type="number" value="{{ $setting?->country_tax }}" class="form-control" id="country_tax" name="country_tax" placeholder="Country Tax">
                            @error('country_tax')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <!-- End Country Tax -->

                        <!-- Start Kilo Meter Price -->
                        <div class="col-lg-3">
                            <label class="col-form-label" for="open_door">Kilo Meter Price</label>
                            <input type="number" value="{{ $setting?->kilo_price }}" class="form-control" id="kilo_price" name="kilo_price" placeholder="Kilo Meter Price">
                            @error('kilo_price')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <!-- End Kilo Meter Price -->
                    </div>
                    <div class="form-group row">
                        <!-- Start Ocean Price -->
                        <div class="col-lg-4">
                            <label class="col-form-label" for="open_door">Ocean</label>
                            <input type="number" value="{{ $setting?->ocean }}" class="form-control" id="ocean" name="ocean" placeholder="Ocean">
                            @error('ocean')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <!-- End Ocean Price -->
                        <!-- Start Company Commission -->
                        <div class="col-lg-4">
                            <label class="col-form-label" for="open_door">Company Commission %</label>
                            <input type="number" value="{{ $setting?->company_commission }}" class="form-control" id="company_commission" name="company_commission" placeholder="Company Commission %">
                            @error('company_commission')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <!-- End Company Commission -->
                        <!-- Start Company Commission -->
                        <div class="col-lg-4">
                            <label class="col-form-label" for="open_door">Company Tax %</label>
                            <input type="number" value="{{ $setting?->company_tax }}" class="form-control" id="company_tax" name="company_tax" placeholder="Company Tax %">
                            @error('company_tax')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <!-- End Company Commission -->
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="col-lg-12">
                            <h5 class="card-title">Peak time fees</h5>
                            <div class="repeater">
                                <div data-repeater-list="peek_time_fees">
                                    @forelse($setting->peekTimeFees as $peekTimeFee)
                                        <div data-repeater-item>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-12">
                                                    <label>Start Date and Time</label>
                                                    <input class="form-control" name="start_date" type="datetime-local" value="{{ $peekTimeFee->start_date }}">
                                                </div>
                                                
                                                <div class="col-lg-3 col-md-3 col-sm-12">
                                                    <label>End Date and Time</label>
                                                    <input class="form-control" name="end_date" type="datetime-local" value="{{ $peekTimeFee->end_date }}">
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-12">
                                                    <label>Peak Price:</label>
                                                    <input class="form-control" type="text" name="price" value="{{ $peekTimeFee->price }}">
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-12">
                                                    <label for="" class="mb-1">Deleted:</label>
                                                    <input style="padding: 12px;" class="btn btn-sm btn-danger btn-block" data-repeater-delete type="button" value="Delete"/>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    @empty
                                        <div data-repeater-item>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-12">
                                                    <label>Start Date and Time</label>
                                                    <input class="form-control" name="start_date" type="datetime-local" value="">
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-12">
                                                    <label>End Date and Time</label>
                                                    <input class="form-control" name="end_date" type="datetime-local" value="">
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-12">
                                                    <label>Peak Price:</label>
                                                    <input class="form-control" type="text" name="price" value="">
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-12">
                                                    <label for="" class="mb-1">Deleted:</label>
                                                    <input style="padding: 12px;" class="btn btn-sm btn-danger btn-block" data-repeater-delete type="button" value="Delete"/>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    @endforelse
                                </div>
                                <div class="row mt-20">
                                    <div class="col-12">
                                        <input class="button" data-repeater-create type="button" value="Add New"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <br>
                    <!-- Start Security Accordion -->
                    <div class="form-row">
                        <div class="col-lg-12 mb-30">     
                            <div class="card card-statistics h-100"> 
                                <div class="card-body">   
                                <h5 class="card-title">Security Panel</h5>
                                    <div class="accordion plus-icon shadow">
                                        <div class="acd-group">
                                            <a href="#" class="acd-heading">Api Secret Key :</a>
                                            <div class="acd-des acd-des-flex">
                                                <label class="col-form-label" for="api_secret_key">Api Secret Key</label>
                                                <input type="text" name="api_secret_key" id="api_secret_key" readonly value="{{ $setting?->api_secret_key }}" class="form-control" placeholder="Api Secret Key">
                                                <button type="button" id="generateKeyBtn" class="btn btn-success">
                                                    <i class="fa fa-key"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>   
                        </div>
                    </div>
                    <!-- End Security Accordion -->
                    <!-- Start Submit Form -->
                    <hr>
                    <div class="form-row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                    <!-- End Submit Form -->
                </form>
                <!-- End Content -->
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
<script>
    $(document).ready(function () {
        var allEditor = document.querySelectorAll(['#road_toll', '#description']);
        for (var i = 0; i < allEditor.length; i++) {
            ClassicEditor.create(allEditor[i], {
                alignment: ['left', 'center', 'right', 'justify'],
            });
        }
    });
    document.getElementById('generateKeyBtn').addEventListener('click', function () {
        var randomKey = generateRandomKey();
        document.getElementById('api_secret_key').value = randomKey;
        document.getElementById('randomKeyDisplay').innerText = "Random Key: " + randomKey;
    });

    function generateRandomKey() {
        var length = 32;
        var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        var result = "";
        for (var i = 0; i < length; i++) {
            var randomIndex = Math.floor(Math.random() * charset.length);
            result += charset.charAt(randomIndex);
        }
        return result;
    }
</script>
@endsection