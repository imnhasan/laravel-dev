<?php

namespace App\Models;

use App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

// File location 👇
// app➡️Models➡️School.php

class School extends Model
{
    use HasFactory;

    public function student() 
    {
        return $this->hasMany(Student::class);
    }
}
