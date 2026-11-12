<?php

namespace App\Http\Controllers\Cache;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;

class CacheController extends Controller
{
    public function cachePost()
    {
        $cache =  Cache::remember('cache_remember_post', '60', function(){
            $post = Post::query()->select('id')->get();
            return $post;
        });

        $checked = Cache::has('posts');

        if($checked) {
            $posts = Cache::get('posts');
        } else {
            $posts = Post::query()->select('id', 'title')->orderBy('id', 'ASC')->get();
            Cache::put('posts', $posts);
        }
        $posts = $this->paginate($posts, 'cache-posts');

        return $cache;
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
        Cache:flush();
    }
}
