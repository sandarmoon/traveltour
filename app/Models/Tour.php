<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Tour extends Model
{
    use HasFactory,SoftDeletes;
    protected $table="tours";
    protected $fillable=['city_id','photo','title','desc'];

    public function packages(){
        return $this->BelongsToMany(Package::class)->withPivot('status');
    }
        
}
