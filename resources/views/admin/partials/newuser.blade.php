<!-- Filter Form -->
<form id="filter-form" method="GET" action="{{ route('admin.newusers') }}" class="form-inline mb-3">
    <input type="text" name="full_name" class="form-control mr-2" placeholder="Full Name"
        value="{{ request('full_name') }}">
    <input type="text" name="email" class="form-control mr-2" placeholder="Email" value="{{ request('email') }}">
    <input type="text" name="mobile" class="form-control mr-2" placeholder="Phone Number"
        value="{{ request('mobile') }}">

    <select name="is_minor" class="form-control mr-2">
        <option value="">Is Minor</option>
        <option value="1" {{ request('is_minor') == '1' ? 'selected' : '' }}>Yes</option>
        <option value="0" {{ request('is_minor') == '0' ? 'selected' : '' }}>No</option>
    </select>

    <select name="status" class="form-control mr-2">
        <option value="">Status</option>
        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
        <option value="disapproved" {{ request('status') == 'disapproved' ? 'selected' : '' }}>Disapproved</option>
    </select>

    <input type="date" name="created_at" class="form-control mr-2" placeholder="Created At"
        value="{{ request('created_at') }}">

    <button type="submit" class="btn btn-primary mr-2">Filter</button>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>S.N</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Is Minor</th>
            <th>Status</th>
            <th>Registered Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if ($newUser->isEmpty())
            <tr>
                <td colspan="7" class="text-center">No data found</td>
            </tr>
        @else
            @foreach ($newUser as $key => $value)
                <tr>
                    <td>{{ $key + 1 + ($newUser->currentPage() - 1) * $newUser->perPage() }}</td>
                    <td>{{ $value->full_name }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->mobile }}</td>
                    <td>{{ $value->is_minor ? 'Yes' : 'No' }}</td>
                    <td>{{ ucfirst($value->status) }}</td>
                    <td>{{ $value->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('admin.show', ['id' => $value->id, 'type' => 'new']) }}"
                            class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('admin.edit', ['id' => $value->id, 'type' => 'new']) }}"
                            class="btn btn-info btn-sm">Edit</a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

<!-- Pagination Links -->
<div class="d-flex justify-content mt-4">
    <nav aria-label="Page navigation">
        {{ $newUser->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
    </nav>
</div>
