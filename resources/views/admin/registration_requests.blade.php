<x-admin.layout>
    <h2 class="mb-3 me-auto">{{ $pending_count }} Registration Request(s) Pending</h2>
    <table class="table table-striped">
        <tr class="table-secondary">
            <th class="text-center">ID</th>
            <th>Email</th>
            <th>Username</th>
            <th>Category</th>
            <th>Details</th>
            <th>Status</th>
            <th>Submitted</th>
            <th>Actions</th>
        </tr>
        @foreach($registration_requests as $registration_request)
            <tr>
                <td class="text-center">{{ $registration_request->id }}</td>
                <td>{{ $registration_request->email }}</td>
                <td>{{ $registration_request->username }}</td>
                <td class="text-capitalize">{{ $registration_request->category }}</td>
                <td>{{ $registration_request->details }}</td>
                <td class="text-capitalize">{{ $registration_request->status }}</td>
                <td><abbr title="{{ $registration_request->created_at->toDayDateTimeString() }}">{{ $registration_request->created_at->diffForHumans() }}</abbr></td>
                <td style="width: 220px">
                    @if($registration_request->status === 'pending')
                        <form class="d-inline" action="/admin/dashboard/registration_requests/{{$registration_request->id}}/approve" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 py-0">Approve</button>
                        </form>
                        <form class="d-inline" action="/admin/dashboard/registration_requests/{{$registration_request->id}}/decline" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3 py-0">Decline</button>
                        </form>
                    @else
                        <div class="btn btn-sm btn-secondary rounded-pill px-3 py-0 disabled">No Actions</div>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

    {{ $registration_requests->links('pagination::bootstrap-5') }}
</x-admin.layout>

