@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Last Login</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
{{--                        <tr>--}}
{{--                            <td>{{ $user->name }}</td>--}}
{{--                            <td>{{ $user->email }}</td>--}}
{{--                            <td>{{ $user->last_login_at->diffForHumans() }} <small class="text-sm">({{ 'need ip address' }})</small></td>--}}
{{--                            <td>{{ $user->last_login_at->diffForHumans() }} <small class="text-sm">({{ $user->last_login_ip_address }})</small></td>--}}
{{--                            <td>{{ $user->lastLogin->created_at->diffForHumans() }} <small class="text-sm">({{ $user->lastLogin->ip_address }})</small></td>--}}
{{--                        </tr>--}}

                        @if($user->lastLogin)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->lastLogin->created_at->diffForHumans() }} <small class="text-sm">({{ $user->lastLogin->ip_address }})</small></td>
                            </tr>
                        @endif

                    @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection







