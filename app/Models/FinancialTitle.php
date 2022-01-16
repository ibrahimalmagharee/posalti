<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialTitle extends Model{

    protected $table = 'financial_titles';

    protected $fillable = ['title_en', 'title_ar', 'value'];
}
