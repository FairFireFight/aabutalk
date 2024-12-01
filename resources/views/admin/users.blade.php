<x-admin.layout>
    <h2 class="mb-3 me-auto">{{ $users_count }} Users</h2>

    <form class="mb-2" action="/admin/dashboard/users" method="GET">
        <div class="input-group mb-3">
            <input type="text" class="form-control rounded-0" placeholder="Search users by email..." name="query" value="{{ $query ?? '' }}">
            <button class="btn btn-aabu px-3 py-0 rounded-0" type="submit"><i class="bi bi-search fs-5"></i></button>
        </div>
    </form>

    <table class="table table-striped">
        <tr class="table-secondary">
            <th class="text-center">ID</th>
            <th>Email</th>
            <th>Username</th>
            <th>Permissions</th>
            <th>Join Date</th>
            <th>Actions</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td class="text-center">{{ $user->id }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->username }}</td>
                <td class="text-capitalize">
                    @php
                        $permissions = json_decode($user->permissions);

                        if (count($permissions) === 0) {
                            echo "None";
                        } else {
                            echo implode(", ", $permissions);
                        }
                    @endphp
                </td>
                <td>{{ $user->created_at->format('jS M Y, h:i A') . ' UTC' }}</td>
                <td>
                    <a href="/admin/dashboard/users/edit/{{ $user->id }}">Manage</a>
                </td>
            </tr>
        @endforeach
    </table>

    {{ $users->appends(['query' => $query])->links('pagination::bootstrap-5') }}
</x-admin.layout>
