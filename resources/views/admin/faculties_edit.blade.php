<x-admin.layout>
    <div class="row">
        <div class="col-9">
            <form action="/admin/dashboard/faculties/{{$faculty->id}}" method="post">
                @csrf
                @method('PUT')
                <label for="id" class="fs-5 mb-1">Faculty ID:</label>
                <input id="id" type="text" class="form-control rounded-0 mb-2" value="{{$faculty->id}}" disabled>

                <label for="name_en" class="fs-5 mb-1">English Name:</label>
                <input id="name_en" name="name_en" type="text" class="form-control rounded-0 mb-2" value="{{$faculty->name_en}}" required>

                <label for="name_ar" class="fs-5 mb-1">Arabic Name:</label>
                <input id="name_ar" name="name_ar" type="text" class="form-control rounded-0 mb-4" value="{{$faculty->name_ar}}" required>

                <label for="description_en" class="fs-5 mb-1">English Description:</label>
                <textarea id="description_en" name="description_en" class="form-control rounded-0 mb-2" required>{{$faculty->description_en}}</textarea>

                <label for="description_ar" class="fs-5 mb-1">Arabic Description:</label>
                <textarea id="description_ar" name="description_ar" class="form-control rounded-0 mb-4" required>{{$faculty->description_ar}}</textarea>

                <button type="submit" class="btn btn-aabu px-5 rounded-pill">Update Details</button>
            </form>
            <form action="/admin/dashboard/faculties/{{$faculty->id}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger px-4 rounded-pill mt-3">Delete</button>
            </form>
        </div>
        <div class="col-3">
            <div class="alert alert-warning">
                <h4>Viewing Faculty</h4>
                <p class="mb-0">
                    You are currently viewing & editing the {{$faculty->name_en}}
                </p>
            </div>
        </div>
    </div>
</x-admin.layout>
