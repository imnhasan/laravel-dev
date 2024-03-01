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
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
{{--                            <td>{{ $user->logins()->latest()->first()->created_at->diffForHumans() }}</td>--}}
{{--                            <td>{{ $user->logins->sortBYDesc('created_at')->first()->created_at->diffForHumans() }}</td>--}}
{{--                            <td>{{ $user->last_login_at }}</td>--}}
                            <td>{{ $user->last_login_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection

