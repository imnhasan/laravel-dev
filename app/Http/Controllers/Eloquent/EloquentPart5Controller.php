<?php

namespace App\Http\Controllers\Eloquent;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class EloquentPart5Controller extends Controller
{
    public function index()
    {
//        $statuses = (object) [];
//        $statuses->requested = Feature::query()->where('status', 'requested')->count();
//        $statuses->planned = Feature::query()->where('status', 'planned')->count();
//        $statuses->completed = Feature::query()->where('status', 'completed')->count();

        $statuses = Feature::query()->toBase()
                    ->selectRaw("count(case when status = 'requested' then 1 end) as requested")
                    ->selectRaw("count(case when status = 'planned' then 1 end) as planned")
                    ->selectRaw("count(case when status = 'completed' then 1 end) as completed")
                    ->first();

        $features = Feature::query()
                    ->withCount('comments')
                    ->paginate();

        return view('eloquent.part-5.features', compact('features', 'statuses'));
    }
}
