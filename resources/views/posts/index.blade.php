@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3>Posts</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">title</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            @if($posts->hasPages())
            {{ $posts->links() }}
            @endif
        </div>
    </div>
</div>

@endsection
