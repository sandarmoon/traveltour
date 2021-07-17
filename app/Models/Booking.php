<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory,SoftDeletes;
     protected $fillable=['booking_code','booking_date','booking_name','user_id','car_id','from_city_id','to_city_id','day','total','pickup_id','custom_pickup','departure_date','arrival_date','pickup_time','status'];
}
