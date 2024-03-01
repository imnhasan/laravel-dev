<?php

namespace App\Http\Controllers\Eloquent;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class EloquentPart6Controller extends Controller
{
    public function show(Feature $feature)
    {
        $feature->load('comments.user');
        $feature->comments->each->setRelation('feature', $feature);

        return view('eloquent.part-6.features', compact('feature'));
    }
}
