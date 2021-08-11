<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Company extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $fillable=['name','logo','ceo_name','photo','phone','addresss','incharge_name','incharge_phone','incharge_position','status','info','service_label_one','service_label_two','service_label_three','service_desc_one','service_desc_two','service_desc_three','user_id'];

    public function cars(){
        return $this->hasMany('App/Model/Car');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
