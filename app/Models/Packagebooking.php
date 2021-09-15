<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Packagebooking extends Model
{
    use HasFactory,SoftDeletes;
    protected $table="package_bookings";
    protected $fillable=['codeno','user_id','package_id','msg','phone','address','ppl','total'];

    public function package(){
        return $this->belongsTo(Package::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
