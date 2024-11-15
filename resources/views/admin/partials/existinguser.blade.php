<!-- Filter Form -->
<form id="filter-form" method="GET" action="{{ route('admin.existingusers') }}" class="form-inline mb-3">
    <input type="text" name="email" class="form-control mr-2" placeholder="Email" value="{{ request('email') }}">
    <input type="text" name="mobile" class="form-control mr-2" placeholder="Phone Number"
        value="{{ request('mobile') }}">

    <select name="status" class="form-control mr-2">
        <option value="">Status</option>
        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
        <option value="disapproved" {{ request('status') == 'disapproved' ? 'selected' : '' }}>Disapproved</option>
    </select>

    <input type="date" name="created_at" class="form-control mr-2" placeholder="Created At"
        value="{{ request('created_at') }}">

    <button type="submit" class="btn btn-primary">Filter</button>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Status</th>
            <th>Registered Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($existingUser as $key => $user)
            <tr>
                <td>{{ $key + 1 + ($existingUser->currentPage() - 1) * $existingUser->perPage() }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->mobile }}</td>
                <td>{{ ucfirst($user->status) }}</td>
                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('admin.show', ['id' => $user->id, 'type' => 'existing']) }}" class="btn btn-info btn-sm">View</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination Links -->
<div class="d-flex justify-content mt-4">
    <nav aria-label="Page navigation">
        {{ $existingUser->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
    </nav>
</div>
