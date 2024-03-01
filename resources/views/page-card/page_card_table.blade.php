@foreach($companies as $company)
<div class="card">
    <div class="card-header"><strong>Name: </strong> {{ __($company->name) }}</div>

    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Company</th>
                    <th scope="col">Phone</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($company->users() as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $company->created_at }}</td>
                    <td>-</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $company->users()->links() }}
    </div>
</div>

@endforeach

{{ $companies->appends(['users' => $company->users()->currentPage()])->links() }}
