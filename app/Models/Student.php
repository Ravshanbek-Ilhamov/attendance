<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',       
    ];

    public function attendance(){
        return $this->hasMany(Attendance::class);
    }

    public function checks($date){
        return $this->attendance()->where('date',$date)->first();
    }
}
