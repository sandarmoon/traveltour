<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['name','desc','depart_id','arrive_id','start','end','priceperperson','discount','days','ppl','company_hotel_id','company_car_id','status'];
    
    public function tours(){
        return $this->BelongsToMany(Tour::class,'tours_packages')->withPivot('status');
    }

    public  function depart(){
        return $this->belongsTo(City::class,'depart_id')->whereNull('parent_id');
    }
    public  function destination(){
        return $this->belongsTo(City::class,'arrive_id')->whereNull('parent_id');
    }

    public function hotel(){
        return $this->belongsTo(Company::class,'company_hotel_id')->where('type',1);
    }

     public function car(){
        return $this->belongsTo(Car::class,'company_car_id');
    }

    public function pbookings(){
        return $this->hasMany(Packagebooking::class);
    }
}
