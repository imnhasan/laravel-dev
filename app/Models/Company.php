<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $fillabale = ['name'];

    public function users()
    {
        return $this->hasMany(User::class, 'company_id', 'id')->paginate($perPage = 5, $columns = ['*'], $pageName = "users");
    }

    public function usersOnly()
    {
        return $this->hasMany(User::class, 'company_id', 'id');
    }
}
