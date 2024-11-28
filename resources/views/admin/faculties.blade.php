<x-admin.layout>
    <div class="d-flex">
        <h2 class="mb-3 me-auto">{{ $faculties->count() }} Faculty(s)</h2>
        <div>
            <a href="/admin/dashboard/faculties/create" class="btn btn-aabu px-4 rounded-0 mt-1">Create New</a>
        </div>
    </div>
    <table class="table table-striped">
        <tr class="table-secondary">
            <th class="text-center">ID</th>
            <th>English Name</th>
            <th>Arabic Name</th>
            <th>Creation Date</th>
            <th>Last Edit</th>
            <th>Actions</th>
        </tr>
        @foreach($faculties as $faculty)
            <tr>
                <td class="text-center">{{ $faculty->id }}</td>
                <td>{{ $faculty->name_en }}</td>
                <td>{{ $faculty->name_ar }}</td>
                <td>{{ $faculty->created_at->format('jS M Y, h:i A') . ' UTC' }}</td>
                <td>{{ $faculty->created_at->diffForHumans() }}</td>
                <td>
                    <a href="/admin/dashboard/faculties/edit/{{ $faculty->id }}">Edit</a>
                </td>
            </tr>
        @endforeach
    </table>
</x-admin.layout>
