@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Company</h2>
                <div id="table">
                    @include('page-card.page_card_table')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- <script type="text/javascript">
        $('body').on('click', '.pagination a', function (e) {
            e.preventDefault();
            let url = this.href;
            console.log(this.href);
    $.ajax({
            type: "GET",
            url: url,
            success: function(data)
            {
            console.log(data); // show response from the php script.
                $("#table").html(data);
            },
            error: function (data)
            {
                console.log('An error occurred.');
                console.log(data);
            },
        });
    }); -->
    </script>
@endpush
