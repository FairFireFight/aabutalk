<x-admin.layout>
    <h2 class="mb-3 me-auto">{{$majors->count()}} Major(s) Registered</h2>

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

            <td class="text-center" style="width: 150px;">
                <input class="form-control rounded-0 text-center" type="text"
                       form="create-form" name="id" placeholder="Major Number" required/>
            </td>

            <td class="text-center">
                <input class="form-control rounded-0" type="text" form="create-form" name="title_en"
                       placeholder="English Title" required/>
            </td>

            <td class="text-center">
                <input class="form-control rounded-0" type="text" form="create-form" name="title_ar"
                       placeholder="Arabic Title" required/>
            </td>

            <td style="width: 200px">
                <input type="submit" form="create-form" value="Add New Major" class="btn btn-outline-aabu rounded-0 px-3">
            </td>
        </tr>

        {{-- stored majors --}}
        @foreach($majors as $major)
            <tr>
                <form action="/admin/dashboard/majors/{{$major->id}}" method="POST" id="major-{{$major->id}}">
                    @csrf
                    @method('PUT')
                </form>

                <td class="text-center" style="width: 150px;">
                    <input class="form-control rounded-0 text-center" type="text" form="major-{{$major->id}}" name="id"
                           placeholder="Major Number" value="{{$major->id}}" required/>
                </td>

                <td class="text-center">
                    <input class="form-control rounded-0" type="text" form="major-{{$major->id}}" name="title_en"
                           placeholder="English Title" value="{{$major->title_en}}"required/>
                </td>

                <td class="text-center">
                    <input class="form-control rounded-0" type="text" form="major-{{$major->id}}" name="title_ar"
                           placeholder="Arabic Title" value="{{$major->title_ar}}"required/>
                </td>

                <td style="width: 200px">
                    <input type="submit" form="major-{{$major->id}}" value="Update" class="btn btn-success rounded-0 px-2">
                    <form action="/admin/dashboard/majors/{{$major->id}}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" class="btn btn-outline-danger rounded-0"/>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</x-admin.layout>
