<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class News extends Model{

    use SoftDeletes;

    protected $fillable = ['category_id' ,'title_en' ,'title_ar' ,'content_en' ,'content_ar' ,'slug_en' ,'slug_ar' ,'user_id'];

    protected $casts = ['created_at' => 'datetime:Y-m-d H:i:s a'];
    protected $table = 'news';
    protected $appends = ['image_path'];

    static $rules = [
        'category_id' => 'required',
        'title_en' => 'required|unique:news',
        'title_ar' => 'required|unique:news',
        'content_en'=> 'required',
        'content_ar'=> 'required',
    ];

    static $messages = [
        'category_id.required' =>'You must choose one of the categories',
        'title_en.required' =>'You must add a title in English',
        'title_ar.required' =>'You must add a title in Arabic',
        'title_en.unique' => 'The Title en must be unique',
        'title_ar.unique' => 'The Title ar must be unique',
        'content_en.required' =>'You must add a content in English',
        'content_ar.required' =>'You must add a content in Arabic',
        'image.required' => 'You must add a image',
    ];

    public function getRouteKeyName(){
        if(App::getLocale() == 'ar' && \Auth::user()->is_admin){
            return 'slug_ar';
        }else{
            return 'slug_en';
        }
    }

    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getImagePathAttribute(){
        return asset('/public/uploads/image_news/'.$this->image->name);
    }
}
