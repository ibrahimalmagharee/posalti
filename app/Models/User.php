<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable{

    use HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'slug',
        'user_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['last_financial_value', 'last_financial_status'];

    public function news(){
        return $this->hasMany(News::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function financials(){
        return $this->hasMany(\App\Models\Financial::class);
    }

    public function last_financial(){
        return \App\Models\Financial::where('user_id', $this->id)->get()->last();
    }

    public function getLastFinancialValueAttribute(){
        return "-";
    }

    public function getLastFinancialStatusAttribute(){
        return "-";
    }
}
