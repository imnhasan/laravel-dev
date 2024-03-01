<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use PhpParser\Node\Expr\FuncCall;

class PostController extends Controller
{

    public function cachePost()
    {
        $checked = Cache::has('posts');

        if($checked) {
            $posts = Cache::get('posts');
        } else {
            $posts = Post::query()->select('id', 'title')->orderBy('id', 'ASC')->get();
            Cache::put('posts', $posts);
        }
        $posts = $this->paginate($posts, 'cache-posts');

        return view('posts.index', compact('posts'));
    }

    public function paginate($items, $pageName = null, $perPage = 15, $page = null, $options = []): LengthAwarePaginator
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        $data = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
        if($pageName) {
            $data->setPath($pageName);
        }
        return $data;
    }

    public function clear()
    {
        Cache::flush();
    }


    public function item()
    {
        $item1 = [
            (object) ['id' => 1, 'title' => 'hello teddy'],
            (object) ['id' => 2, 'title' => 'hello buuny'],
            (object) ['id' => 3, 'title' => 'hello jonny'],
            (object) ['id' => 4, 'title' => 'hello ronny'],
            (object) ['id' => 5, 'title' => 'hello monny'],
        ];

        $item2 =  [
            (object) ['id' => 6, 'title' => 'hello orrpra'],
            (object) ['id' => 7, 'title' => 'hello teddaa'],
            (object) ['id' => 8, 'title' => 'hello polly'],
            (object) ['id' => 9, 'title' => 'hello salsa'],
            (object) ['id' => 10, 'title' => 'hello laila'],
        ];

        $items = collect($item1)->merge($item2);

        $posts = $this->paginate($items, 'items', 2);

        return view('posts.index', compact('posts'));

    }



    public function index()
    {
        $years = Post::query()
            ->select('id', 'title', 'slug', 'published_at', 'author_id')
//            ->with('author')
//            ->with(['author' => function($query) {
//                $query->select('id', 'name');
//            }])
            ->with('author:id,name') // this is the short form
            ->latest('published_at')
            ->get()
            ->groupBy(fn ($post) => $post->published_at->year);

        return view('eloquent.part-2.index', compact('years'));
    }


}
