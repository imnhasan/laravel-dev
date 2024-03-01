@extends('layouts.app')

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
        <a href="javascript:void(0)" onclick="addAlertModal()" class="btn btn-sm fw-bold bg-body btn-color-gray-700 btn-active-color-primary" data-bs-toggle="modal" data-bs-target="#modal_alert">Add Alert</a>
        <!--end::Secondary button-->
    </div>
    <!--end::Actions-->

    @if ( session('success') || session('error') )
        <div class="alert {{ session('success') ? 'bg-light-success alert-success' : 'bg-light-danger alert-danger'}} alert-dismissible" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="alert-message">
                <span class="{{ session('success') ? 'text-success' : 'text-danger'}}">{{ session('success') ?? session('error') }}</span>
            </div>
        </div>
    @endif

    <!--begin::Tables Widget 11-->
    <div class="card mb-5 mb-xl-8">
        <!--begin::Body-->
        <div class="card-body py-3">

            {{--display data--}}
            @if (!$categories->isEmpty())
                <section id="ajaxContainer">
                    @include('categories.ajax')
                </section>
            @else
                <h1>No data found!</h1>
            @endif

        </div>
        <!--begin::Body-->
    </div>
    <!--end::Tables Widget 11-->


    <!--begin::Modal - Alert-->
    <div class="modal fade" id="modal_alert" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"/>
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"/>
								</svg>
							</span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <!--begin:Form-->
                    <form id="formAlert" class="form" action="{{ route('category.store_update') }}" method="post">
                        @csrf
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Category</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->

                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <label for="formPrice" class="required fs-6 fw-semibold mb-2">Price</label>
                                <input id="formPrice" name="price" type="text" min="0" step="any" class="form-control form-control-solid" placeholder="Enter Target Price" autocomplete="off"/>
                            </div>
                        </div>
                        <!--end::Input group-->

                        <input type="hidden" id="id" name="id">



                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" id="formCancelBtn" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="formSubmitBtn" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end:Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Alert-->
@endsection

@push('scripts')
    <script>
        $('#formExchangeSlug').on('change', function () {
            if (this.value === "") {
                $('#sectionMainRows').hide();
            } else {
                $('#sectionMainRows').show();
            }
            $('#formSymbol').val('');
        });

        // search symbol
        $('#formSymbol').select2({
            ajax: {
                url: '{{ route('admin.tickers.get') }}',
                dataType: 'json',
                delay: 250, // wait 250 milliseconds before triggering the request
                data: function (params) {
                    return {
                        q: params.term,
                        exchange: $('#formExchangeSlug').val()
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.items
                    };
                }
            },
            minimumInputLength: 2,
        });

        // on change active auto buy checkbox
        $('input[type=checkbox][name=auto_buy]').change(function () {
            if (document.getElementById('formAutoBuy').checked) {
                $('#sectionAutoBuy').show();
            } else {
                $('#sectionAutoBuy').hide();
            }
        });

        // edit
        function edit(alert) {
            $('#formId').val(alert.id);
            $('#formExchangeSlug option[value=' + alert.exchange_slug + ']').prop('selected', 'selected').change();
            // symbol select2
            let create_symbol_option = new Option(alert.symbol, alert.symbol, true, true);
            $('#formSymbol').append(create_symbol_option).trigger('change');

            $('#formPrice').val(alert.price);
            $('#formCondition').val(alert.condition_id);
            $('#formPercentage').val(alert.percentage);
            $('#formPercentageMode option[value=' + alert.percentage_mode + ']').prop('selected', 'selected').change();
            console.log(alert.auto_buy);
            if (alert.auto_buy === 1) {
                $('#formAutoBuy').prop("checked", true);
                $('#sectionAutoBuy').show();
            } else {
                $('#formAutoBuy').prop("checked", false);
                $('#sectionAutoBuy').hide();
            }
            $('#formAutoBuyValue').val(alert.auto_buy_quantity);
            $('#sectionMainRows').show();
            $('#formSubmitBtn').text('Update');
            $('#modal_alert').modal('show');
        }

        // destroy alert
        function destroy(id) {
            swal.fire({
                title: "Are you sure?",
                text: "You want to delete this alert.",
                icon: "warning",
                buttonsStyling: true,
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonText: "Yes, delete",
                cancelButtonText: 'Nope, cancel',
                customClass: {
                    confirmButton: "btn btn-danger",
                    cancelButton: 'btn btn-light'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#form_delete_" + id).submit();
                }
            });
        }

        // modal prevent outside click
        $(function () {
            $('#modal_alert').modal({
                backdrop: 'static',
                keyboard: false
            })
        });

        // add alert modal
        function addAlertModal() {
            console.log('modal');
            $('#formId').val("");

            // choose buy type
            $('#formAutoBuyType option[value=' + 'quantity' + ']').prop('selected', 'selected').change();
            $('#formAutoBuyValue').val('');
            $('#formQuantityValue').val("");

            // symbol select2
            let create_symbol_option = new Option('', '', true, true);
            $('#formExchangeSlug').append(create_symbol_option).trigger('change');
            $('#formSymbol').append(create_symbol_option).trigger('change');

            $('#sectionMainRows').hide();

            $('#formPrice').val('');
            $('#formCondition').val('');
            $('#formPercentageMode option[value="Off"]').prop('selected', 'selected').change();
            $('#formPercentage').val('');

            $('#formAutoBuy').prop("checked", false);
            $('#sectionAutoBuy').hide();

            $('#formSubmitBtn').text('Set');
        }

        // on change buy type & value
        $('#formAutoBuyType').on('change', function () {
            if (this.value === 'quantity') {
                $('#formQuantityValue').val($('#formAutoBuyValue').val());
                $('#estQuantityNotice').hide();
            } else {
                getEstimatedQuantity($('#formAutoBuyValue').val());
            }
        });
        $('#formAutoBuyValue').on('keyup', function () {
            let buy_type = $('#formAutoBuyType').val();
            if (buy_type === 'quantity') {
                $('#formQuantityValue').val($('#formAutoBuyValue').val());
                $('#estQuantityNotice').hide();
            } else {
                getEstimatedQuantity($('#formAutoBuyValue').val());
            }
        });
        $('#formSymbol').on('change', function () {
            let buy_type = $('#formAutoBuyType').val();
            if (buy_type === 'quantity') {
                $('#formQuantityValue').val($('#formAutoBuyValue').val());
                $('#estQuantityNotice').hide();
            } else {
                getEstimatedQuantity($('#formAutoBuyValue').val());
            }
        });

        // amount to quantity
        function getEstimatedQuantity(amount) {
            let symbol = $('#formSymbol').val();
            if (symbol) {
                $.ajax({
                    url: "{{ route('admin.trades.amount_to_quantity') }}",
                    type: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "symbol": symbol,
                        "amount": amount,
                    },
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);
                        if (response.success) {
                            $('#formQuantityValue').val(response.quantity);
                            $('#estQuantity').text(response.quantity + ' ' + response.coin);
                            $('#coinCurrentRate').text('$' + response.rate);
                            $('#estQuantityNotice').show();
                        } else {
                            swal.fire({
                                text: 'Please enter quantity instead of amount for this coin.',
                                icon: 'warning'
                            });
                        }
                    }
                });
            } else {
                swal.fire({
                    text: "Please select symbol!",
                    icon: "warning",
                });
                $('#formAutoBuyValue').val(null); // reset
            }
        }
    </script>

    <script>
        // ajax pagination
        $(function () {
            $('body').on('click', '.pagination a', function (e) {
                e.preventDefault();
                $('#ajaxTable').append('<img class="ajaxTableLoader" src="{{ asset('backend/img/loader.gif') }}" />');
                let url = $(this).attr('href');
                window.history.pushState("", "", url);
                loadData(url);
            });

            function loadData(url) {
                $("#ajaxTable").addClass("onLoading");
                $.ajax({
                    url: url
                }).done(function (data) {
                    $("#ajaxContainer").empty().html(data);
                    $("#ajaxTable").removeClass("onLoading");
                }).fail(function () {
                    $("#ajaxTable").removeClass("onLoading");
                });
            }
        });
    </script>
@endpush
