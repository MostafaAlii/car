<div class="modal fade" id="uploadCar{{$data['captain']->car->id}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{'Upload Car Media '. $data['captain']->name }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{-- route('captains.uploadCarMedia') --}}" enctype="multipart/form-data">
                    @csrf
                    @foreach ($emptyFields as $field)
                    <div class="form-group">
                        <label for="{{ $field }}">{{ ucfirst(str_replace('_', ' ', $field)) }} Image:</label>
                        <input type="file" class="form-control" id="{{ $field }}" name="{{ $field }}">
                    </div>
                    <input type="hidden" name="name_photo" value="{{ json_encode($emptyFields->toArray()) }}">
                    @endforeach
                    <input type="hidden" name="id" value="{{ $data['captain']->car->id }}">
                    <button type="submit" class="btn btn-success">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>