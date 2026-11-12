<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PHPUnit\TextUI\CliArguments\Exception;

class AjaxController extends Controller
{
    public function index()
    {
        $title = 'Ajax';
        return view('ajax.index', compact('title'));
    }

    public function store(Request $request)
    {
        // type 1 -----
        /*
        $validator = $request->validate([
           'title' => 'numeric',
        ]);
        */

        // type 2 -----
        /*
        $validator = Validator::make($request->all(), [
            'title' => 'numeric|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('ajax.index')
                ->withErrors($validator)
                ->withInput();
        }
        */

        // type 3 -----
        /*
        $validator = Validator::make($request->all(), [
            'title' => 'numeric|max:255',
        ]);
        $errors = $validator->errors();
        if($validator->fails()) {
            return response()->json($errors);
        }
        */

//        try {
//            $post = new Post();
//            $post->author_id = $request->author_id;
//            $post->title = $request->title;
//            $post->slug = Str::slug($request->slug);
//            $post->body = $request->body;
//            $post->published_at = $request->published_at;
//            $post->save();
//            $response = [
//                'status' => 'success',
//                'message' => 'Post added',
//            ];
//        } catch (\Exception $exception) {
//            $response = [
//                'status' => 'error',
//                'message' => $exception->getMessage(),
//            ];
//        }

        try {
            $userStore = DB::table('posts')
                ->join('store_user', 'store_user.store_id', '=','stores.id')
                ->select('stores.id')
                ->where('store_user.user_id', auth()->id())
                ->pluck('id');
            if($userStore->count() > 0) {
                return $userStore;
            }

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
        return 0;



    }

    public function indexCrud()
    {
        return view('ajax.crud');
    }

    public function storeCrud(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $validatedData = $validator->validated();

        // Create the user or perform other actions
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ], 201);
    }
}
