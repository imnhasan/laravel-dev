<?php

namespace App\Models;

use App\Models\School;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    //protected $with = ['school'];

    /*
     *  but I don't recommend this with variable in model call. cause each time it's called
     *  when we call Student Model
     */

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
