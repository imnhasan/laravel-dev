@extends('layouts.app-old')

@section('content')

    <form id="userForm">
        @csrf
        <label>
            <input type="text" name="name" placeholder="Name">
        </label>
        <label>
            <input type="email" name="email" placeholder="Email">
        </label>
        <label>
            <input type="password" name="password" placeholder="Password">
        </label>
        <label>
            <input type="password" name="password_confirmation" placeholder="Confirm Password">
        </label>
        <button type="submit">Submit</button>
    </form>

    <div id="errorMessages"></div>

    <script>
        $(document).ready(function () {
            $('#userForm').on('submit', function (event) {
                event.preventDefault();

                $.ajax({
                    url: '{{ route('ajax.store.crud') }}', // Adjust the URL to your route
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        // Handle the success response
                        alert('User created successfully');
                    },
                    error: function (xhr) {
                        // Handle validation errors
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let errorMessages = '';

                            $.each(errors, function (key, value) {
                                errorMessages += '<p>' + value[0] + '</p>';
                            });

                            $('#errorMessages').html(errorMessages);
                        } else {
                            // Handle other errors
                            alert('An error occurred. Please try again.');
                        }
                    }
                });
            });
        });
    </script>

@endsection
