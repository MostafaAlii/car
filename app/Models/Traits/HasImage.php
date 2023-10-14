<?php
namespace App\Models\Traits;
use App\Models\Image;
trait HasImage {
    public static function bootHasImage() {
        static ::deleting(function ($model) {
            $model->deleteImage();
        });
    }

    public function image() {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function storeImage($filename) {
        $image = $this->image()->create([
            'filename' => pathinfo($filename, PATHINFO_FILENAME) . '.' . pathinfo($filename, PATHINFO_EXTENSION),
        ]);
        return $image;
    }

    public function updateImage($filename) {
        if ($this->image) 
            $this->image->delete();
        $this->storeImage($filename);
    }

    public function deleteImage() {
        if ($this->image) 
            $this->image->delete();
    }

    public function ImagePath() {
        $image = $this->image;
        $imageType = strtolower(class_basename($this));
        if (! $image)
            return asset("dashboard/img/default/default_{$imageType}.jpg");
        return asset("dashboard/img/{$imageType}/" . $image->filename);
    }
}