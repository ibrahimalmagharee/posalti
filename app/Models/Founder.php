<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Founder extends Model{
    protected $table = 'founders';

    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $appends=['image_path'];

    public function getImagePathAttribute(){
        return asset('/public/uploads/image_founder/'.$this->image->name);
    }
}
