@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-2">
                    <div class="card-body">
                        <h4>{{ $feature->title }} <strong class="badge bg-info text-primary">{{ $feature->status }}</strong></h4>
                    </div>
                </div>
                <ul class="list-group">
                   @foreach($feature->comments as $comment)
                        <li class="list-group-item"><strong>{{ $comment->user->name }}</strong>,
                            @if($comment->isAuthor())
                                 <span class="badge bg-primary">Author</span>
                            @endif
                            {{ $comment->comment }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection







