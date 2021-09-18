<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
class Rating extends Model
{
    use HasFactory,SoftDeletes;
     protected $fillable=['user_id','car_id','company_hotel_id','type_id','rate'];


    public function car($value='')
    {
        return $this->belongsTo('App\Models\Car');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
