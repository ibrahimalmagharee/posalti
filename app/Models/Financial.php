<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Financial extends Model{

    use SoftDeletes;

    protected $fillable = ['user_id', 'title_id', 'value'];

    protected $casts = ['created_at' => 'datetime:Y-m-d H:i:s a', 'payment_created_at' => 'datetime:Y-m-d H:i:s a'];

    static $rules = [
        'user_id'=> 'required',
        'title_id'=> 'required',
        'value'=> 'required',
    ];

    static $messages = [
        'user_id.required' => 'You must add a student',
        'title_id.required' => 'You must add a title',
        'value.required' => 'You must add a value',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function title(){
        return $this->belongsTo(FinancialTitle::class, 'title_id');
    }

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }
}
