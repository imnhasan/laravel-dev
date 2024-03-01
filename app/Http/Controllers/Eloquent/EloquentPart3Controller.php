<?php

namespace App\Http\Controllers\Eloquent;

use App\Http\Controllers\Controller;
use App\Models\Login;
use App\Models\User;
use Illuminate\Http\Request;

class EloquentPart3Controller extends Controller
{
    public function index()
    {

//        $users = User::query()
//            ->orderBy('name')
//            ->paginate();


//        $users = User::query()
//            ->with('logins')
//            ->orderBy('name')
//            ->paginate();


//        $users = User::query()
//            ->addSelect(['last_login_at' => Login::query()
//                ->select('created_at')
//                ->whereColumn('user_id', 'users.id')
//                ->latest()
//                ->take(1)
//            ])
//            ->orderBy('name')
//            ->paginate();


//        $users = User::query()
//            ->addSelect(['last_login_at' => Login::query()
//                ->select('created_at')
//                ->whereColumn('user_id', 'users.id')
//                ->latest()
//                ->take(1)
//            ])
//            ->withCasts(['last_login_at' => 'datetime'])
//            ->orderBy('name')
//            ->paginate();

        $users = User::query()
            ->withLastLoginAt()
            ->orderBy('name')
            ->paginate();

        return view('eloquent.part-3.users', compact('users'));
    }
}
