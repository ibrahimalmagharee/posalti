<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model{

    use SoftDeletes;

    protected $fillable = ['name_en', 'name_ar', 'user_id'];

    protected $casts = ['created_at' => 'datetime:Y-m-d H:i:s a'];

    static $rules = [
        'name_en'=> 'required',
        'name_ar'=> 'required',
    ];

    static $messages = [
        'name_en.required' => 'You must add a name in English',
        'name_ar.required' => 'You must add a name in Arabic',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function news(){
        return $this->hasMany(News::class, 'category_id');
    }
}
