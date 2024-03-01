<?php

namespace App\Http\Controllers\Eloquent;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EloquentPart4Controller extends Controller
{
    public function index()
    {

//        $users = User::query()
//            ->withLastLoginAt()
//            ->orderBy('name')
//            ->paginate();

//        $users = User::query()
//            ->withLastLoginAt()
//            ->withLastLoginIpAddress()
//            ->orderBy('name')
//            ->paginate();

//        $users = User::query()
//            ->withLastLogin()
//            ->orderBy('name')
//            ->paginate();

//        $users = User::query()
//            ->orderBy('name')
//            ->paginate();

        $users = User::query()
            ->with('lastLogin')
            ->orderBy('name')
            ->paginate();




        return view('eloquent.part-4.users', compact('users'));
    }
}




























