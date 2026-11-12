@extends('layouts.app-old')

@section('content')

    <h1>Manual Validation Create</h1>
    <hr>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('validation.manual-validation-store') }}" class="row g-3">
        @csrf
        <div class="col-12">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Demo Name">
            @error('name')
            <span class="text-danger">{{ $message }}</snap>
            @enderror
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection
