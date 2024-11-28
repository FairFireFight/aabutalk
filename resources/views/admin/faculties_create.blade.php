<x-admin.layout>
    <div class="row">
        <div class="col-9">
            <form action="/admin/dashboard/faculties" method="post">
                @csrf
                <label for="name_en" class="fs-5 mb-1">English Name:</label>
                <input id="name_en" name="name_en" type="text" class="form-control rounded-0 mb-2" required>

                <label for="name_ar" class="fs-5 mb-1">Arabic Name:</label>
                <input id="name_ar" name="name_ar" type="text" class="form-control rounded-0 mb-4" required>

                <label for="description_en" class="fs-5 mb-1">English Description:</label>
                <textarea id="description_en" name="description_en" class="form-control rounded-0 mb-2" required></textarea>

                <label for="description_ar" class="fs-5 mb-1">Arabic Description:</label>
                <textarea id="description_ar" name="description_ar" class="form-control rounded-0 mb-4" required></textarea>

                <button type="submit" class="btn btn-aabu px-5 rounded-0">Submit</button>
            </form>
        </div>
        <div class="col-3">
            <div class="alert alert-warning">
                <h4>All fields are required!</h4>
                <p class="mb-0">
                    Please care to localize the faculty name and description in order to maintain accessibility for all students.
                </p>
            </div>
        </div>
    </div>

</x-admin.layout>
