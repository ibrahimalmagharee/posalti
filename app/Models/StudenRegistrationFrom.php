<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudenRegistrationFrom extends Model{

    protected $table = 'studen_registration_froms';

    protected $fillable = ['user_id', 'first_name', 'second_name', 'last_name', 'birth_date',
     'school_name', 'educational_level', 'mobile_number', 'father_name1', 'father_mobile_number1', 'father_name', 'father_mobile_number', 'agree_to_terms'];

    public function student(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
