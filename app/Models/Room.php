<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['name','type_id','photos','wide','single','double','king','queen','ppl','pricepernight','company_id','status','common'];

    public function  facilities(){
        return $this->belongsToMany(Facility::class);
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
