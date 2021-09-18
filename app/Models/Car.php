<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory,SoftDeletes;
    
    
     protected $fillable=['name','codeno','photo','model','seats','doors','bags','aircon','status','brand_id','type_id','company_id','priceperday','discount','qty','city_id'];

     public function company(){
        return $this->belongsTo(Company::class);
     }

     public function type(){
        return $this->belongsTo(Type::class);
     }

     public function brand(){
        return $this->belongsTo(Brand::class);
     }

     public function  pickuppivot(){
        return $this->belongsToMany('App\Models\City')->withPivot('id');
    }

    public function  city(){
        return $this->belongsTo('App\Models\City');
    }

    public function rating($value='')
    {
       return $this->hasMany('App\Models\Rating');
    }

    public function userRating(){
        return $this->belongsTo(User::class);
    }
}
