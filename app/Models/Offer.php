<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    //
    protected $fillable = ['photo','name_ar','name_en', 'price', 'details_ar','details_en', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at','price'];
    //public $timestamps = false;
}
