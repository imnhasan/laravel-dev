<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DataTableController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

//            $post = Post::query()->with('author');
//
//            return Datatables::of($post)
//                ->addColumn('user', function (Post $post) {
//                    return $post->author->name;
//                })
//                ->rawColumns(['user'])
//                ->make(true);

            $users = User::query()->with('post');

            return Datatables::of($users)
                ->addColumn('post', function (User $user) {
                    return (!empty($user->post)) ? $user->post->title : 'not found';
                })
                ->rawColumns(['post'])
                ->make(true);

        }

        return view('data-table.index');
    }
}
