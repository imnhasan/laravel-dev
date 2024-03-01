@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($years as $year => $posts)
        <div class="row justify-content-center">
            <div class="col-md-8 mt-2">
                <h2>{{ $year }}</h2>
                <hr>
                <div class="row">
                    @foreach ($posts as $post)
                    <div class="col-sm-6 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                <p><a href="#">{{ $post->slug }}</a></p>
                                <footer class="blockquote-footer">Posted {{ $post->published_at->toFormattedDateString() }} by {{ $post->author->name}} <cite title="Source Title">Source Title</cite></footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
