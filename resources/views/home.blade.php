@extends('layouts.app-old')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('URL') }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="list-group">
                                    <a href="{{ route('datatable.index') }}"
                                       class="list-group-item list-group-item-action">Data Table</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
