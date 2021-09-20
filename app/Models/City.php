<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['name','parent_id'];

    public function pickup()
    {
        return $this->hasMany(\App\Models\City::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(\App\Models\City::class, 'parent_id');
    }

    public function  carpivot(){
        return $this->belongsToMany('App\Models\Car')->withPivot('id');
    }

    public function tours($value='')
    {
        return $this->hasMany('App\Models\Tour');
    }
}

