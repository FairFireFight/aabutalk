<x-admin.layout>
    <h2 class="mb-3 me-auto">0 Major(s) Registered</h2>

    <table class="table table-striped">
        <tr class="table-secondary">
            <th>Major Number</th>
            <th>English Title</th>
            <th>Arabic Title</th>
            <th>Actions</th>
        </tr>

        {{-- first row for creating major --}}
        <tr>
            <form action="/admin/dashboard/majors" method="POST" id="create-form">
                @csrf
            </form>
            <td class="text-center" style="width: 150px;"><input class="form-control rounded-0 text-center" type="text" form="create-form" name="id" placeholder="Major Number" required/></td>
            <td class="text-center"><input class="form-control rounded-0" type="text" form="create-form" name="title_en" placeholder="English Title" required/></td>
            <td class="text-center"><input class="form-control rounded-0" type="text" form="create-form" name="title_ar" placeholder="Arabic Title" required/></td>

            <td style="width: 150px">
                <input type="submit" form="create-form" value="Add New Major" class="btn btn-outline-aabu rounded-0 px-2">
            </td>
        </tr>
    </table>
</x-admin.layout>
