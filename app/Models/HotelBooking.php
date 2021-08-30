<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelBooking extends Model
{
    use HasFactory,SoftDeletes;
     protected $fillable=['user_id','codeno','booking_date','check_in','check_out',
     'room_id','days','total','taxfee','adult','child','status','phone','address','msg'];


      public function user(){
        return $this->belongsTo(User::class);
     }

     public function room(){
         return $this->belongsTo(Room::class);
     }

   
}
