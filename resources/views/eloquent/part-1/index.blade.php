@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Studnets</h2>
                <div id="table">
                    <div class="card">
                        <div class="card-header">Data of Students</div>

                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">School</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">State</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <th scope="row">{{ $student->id }}</th>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->school->name }}</td>
                                        <td>{{ $student->phone_number }}</td>
                                        <td>{{ $student->state }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                {{ $students->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
