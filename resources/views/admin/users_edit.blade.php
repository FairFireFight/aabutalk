<x-admin.layout>
    <div class="row">
        <div class="col-9">
            <form action="/admin/dashboard/users/edit/{{ $user->id }}" method="POST">
                @csrf
                @method('PUT')

                <label for="id" class="form-label fs-5 mb-1">User ID</label>
                <input type="text" class="form-control mb-3" disabled readonly value="{{ $user->id }}">

                <label for="id" class="form-label fs-5 mb-1">Email</label>
                <input type="text" class="form-control mb-3" disabled readonly value="{{ $user->email }}">

                <label for="id" class="form-label fs-5 mb-1">Username</label>
                <input type="text" class="form-control mb-4" name="username" value="{{ $user->username }}">

                <h5 class="text-secondary border-bottom pb-2">Permissions</h5>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="admin" value="true" id="admin-check">
                    <label class="form-check-label" for="admin-check">
                        Access Control Panel
                    </label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="moderator" value="true" id="moderator-check">
                    <label class="form-check-label" for="moderator-check">
                        Moderate Posts
                    </label>
                </div>

                <div class="d-flex gap-3 mt-4">
                    <button type="submit" class="btn btn-outline-aabu px-5 rounded-pill">Update</button>
                </div>
            </form>
        </div>
        <div class="col">
            <div class="alert alert-warning">
                <h4>You're currently editing a user</h4>
                <p class="m-0">Please double check any changes that you make, especially permissions.</p>
            </div>
        </div>
    </div>
</x-admin.layout>
