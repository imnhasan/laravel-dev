@extends('layouts.app-old')

@section('content')

    <!--begin::Page title-->
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{ $title }}</h1>
        <!--end::Title-->
    </div>
    <!--end::Page title-->
    <!--begin::Actions-->
    <div class="d-flex align-items-center gap-2 gap-lg-3">
        <!--begin::Secondary button-->
        <a href="javascript:void(0)" onclick="addAlertModal()"
           class="btn btn-sm fw-bold bg-body btn-color-gray-700 btn-active-color-primary" data-bs-toggle="modal"
           data-bs-target="#modal_alert">Add Alert</a>
        <!--end::Secondary button-->
    </div>
    <!--end::Actions-->

    @if ( session('success') || session('error') )
        <div
            class="alert {{ session('success') ? 'bg-light-success alert-success' : 'bg-light-danger alert-danger'}} alert-dismissible"
            role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="alert-message">
                <span
                    class="{{ session('success') ? 'text-success' : 'text-danger'}}">{{ session('success') ?? session('error') }}</span>
            </div>
        </div>
    @endif

    <!--begin::Tables Widget 11-->
    <div class="card mb-5 mb-xl-8">
        <!--begin::Body-->
        <div class="card-body py-3">

            <form id="ajax">
                <div class="mb-3">
                    <input type="hidden" id="id" name="id">
                    <label for="author_id">Auth Id</label>
                    <input type="number" class="form-control" id="author_id" name="author_id" value="1">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="Title">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" aria-describedby="Slug">
                    <label for="body">Body</label>
                    <textarea class="form-control" id="body" name="body"></textarea>
                    <label for="published_at">Publish At</label>
                    <input type="date" class="form-control" id="published_at" name="published_at">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            {{--display data--}}
            {{--            @if (!$categories->isEmpty())--}}
            {{--                <section id="ajaxContainer">--}}
            {{--                    @include('categories.ajax')--}}
            {{--                </section>--}}
            {{--            @else--}}
            {{--                <h1>No data found!</h1>--}}
            {{--            @endif--}}

        </div>
        <!--begin::Body-->
    </div>
    <!--end::Tables Widget 11-->


    <!--begin::Modal - Alert-->
    {{--    <div class="modal fade" id="modal_alert" tabindex="-1" aria-hidden="true">--}}
    {{--        <!--begin::Modal dialog-->--}}
    {{--        <div class="modal-dialog modal-dialog-centered mw-650px">--}}
    {{--            <!--begin::Modal content-->--}}
    {{--            <div class="modal-content rounded">--}}
    {{--                <!--begin::Modal header-->--}}
    {{--                <div class="modal-header pb-0 border-0 justify-content-end">--}}
    {{--                    <!--begin::Close-->--}}
    {{--                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">--}}
    {{--                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->--}}
    {{--                        <span class="svg-icon svg-icon-1">--}}
    {{--								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
    {{--									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"/>--}}
    {{--									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"/>--}}
    {{--								</svg>--}}
    {{--							</span>--}}
    {{--                        <!--end::Svg Icon-->--}}
    {{--                    </div>--}}
    {{--                    <!--end::Close-->--}}
    {{--                </div>--}}
    {{--                <!--begin::Modal header-->--}}
    {{--                <!--begin::Modal body-->--}}
    {{--                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">--}}
    {{--                    <!--begin:Form-->--}}
    {{--                    <form id="formAlert" class="form" action="{{ route('category.store_update') }}" method="post">--}}
    {{--                        @csrf--}}
    {{--                        <!--begin::Heading-->--}}
    {{--                        <div class="mb-13 text-center">--}}
    {{--                            <!--begin::Title-->--}}
    {{--                            <h1 class="mb-3">Category</h1>--}}
    {{--                            <!--end::Title-->--}}
    {{--                        </div>--}}
    {{--                        <!--end::Heading-->--}}

    {{--                        <!--begin::Input group-->--}}
    {{--                        <div class="row g-9 mb-8">--}}
    {{--                            <div class="col-md-6 fv-row">--}}
    {{--                                <label for="formPrice" class="required fs-6 fw-semibold mb-2">Price</label>--}}
    {{--                                <input id="formPrice" name="price" type="text" min="0" step="any" class="form-control form-control-solid" placeholder="Enter Target Price" autocomplete="off"/>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <!--end::Input group-->--}}

    {{--                        <input type="hidden" id="id" name="id">--}}



    {{--                        <!--begin::Actions-->--}}
    {{--                        <div class="text-center">--}}
    {{--                            <button type="reset" id="formCancelBtn" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>--}}
    {{--                            <button type="submit" id="formSubmitBtn" class="btn btn-primary">--}}
    {{--                                <span class="indicator-label">Submit</span>--}}
    {{--                                <span class="indicator-progress">Please wait...--}}
    {{--									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>--}}
    {{--                            </button>--}}
    {{--                        </div>--}}
    {{--                        <!--end::Actions-->--}}
    {{--                    </form>--}}
    {{--                    <!--end:Form-->--}}
    {{--                </div>--}}
    {{--                <!--end::Modal body-->--}}
    {{--            </div>--}}
    {{--            <!--end::Modal content-->--}}
    {{--        </div>--}}
    {{--        <!--end::Modal dialog-->--}}
    {{--    </div>--}}
    <!--end::Modal - Alert-->
@endsection

@push('script')
    <script>
        $(function () {
            console.log($);
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
            });
            $('#ajax').submit(function (e) {
                e.preventDefault();
                let data = $(this).serialize();
                let id = $('#id').val();
                let url = "{{ route('ajax.store') }}";
                console.log(data);
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: data,
                    success: function (data) {
                        console.log(data);
                        alert(data);
                        // window.location.href = window.location.href.replace(/#.*$/, '');
                    },
                    error: function (error) {
                        console.log(error)
                        let errors = error.responseJSON.errors
                        console.log(error.responseJSON.errors);
                    }
                })

            })
        })
    </script>
@endpush
