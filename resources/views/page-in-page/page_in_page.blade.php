@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Company</h2>
                <div id="table">
                    @include('page-in-page.page_in_page_table')
                </div>
            </div>
        </div>
    </div>
@endsection
