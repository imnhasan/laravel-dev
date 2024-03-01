@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Features</h2>
        <hr>
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Requested - {{ $statuses->requested }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Planned - {{ $statuses->planned }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Completed - {{ $statuses->completed }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">TITLE</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">COMMENTS</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($features as $feature)
                            <tr>
                                <td>{{ $feature->title }}</td>
                                <td><span class="badge bg-primary">{{ $feature->status }}</span></td>
                                <td>{{ $feature->comments_count }} comments</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $features->links() }}
            </div>
        </div>
    </div>
@endsection







