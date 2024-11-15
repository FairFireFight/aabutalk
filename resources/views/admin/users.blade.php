<x-admin.layout>
    <h2 class="mb-3 me-auto">{{ $users_count }} Users</h2>
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

    {{ $users->links('pagination::bootstrap-5') }}
</x-admin.layout>
