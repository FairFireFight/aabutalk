<x-admin.layout>
    <div class="alert alert-light">
        <h4>👋 Welcome to the administration dashboard.</h4>
        <p class="m-0">
            Through the control panel, you are able to manage registration requests, adjust user privileges, view activity and much more.
        </p>
    </div>

    <div class="row">
        <div class="col-3">
            <div class="px-3 py-1 rounded shadow-sm bg-aabu">
                <div class="row gx-2">
                    <div class="col-3 text-center" style="font-size: 5rem; margin-top: -16px">
                        0
                    </div>
                    <div class="col fs-4 text-center">
                        <div class="h-100 d-flex align-items-center text-center pb-2">Unmanaged registration requests</div>
                    </div>
                </div>
                <a href="/admin/registration_requests" class="d-block btn btn-outline-light px-3 py-1 rounded-pill mb-2" style="margin-top: -8px">View</a>
            </div>
        </div>

        <div class="col-3">
            <div class="px-3 py-1 rounded shadow-sm border">
                <div class="row gx-2">
                    <div class="col-3 text-center" style="font-size: 5rem; margin-top: -16px">
                        {{ $users_count }}
                    </div>
                    <div class="col fs-4 text-center">
                        <div class="h-100 d-flex align-items-center text-center pb-2">Newly registered users in the last 24 hours</div>
                    </div>
                </div>
                <a href="/admin/users" class="d-block btn btn-outline-aabu px-3 py-1 rounded-pill mb-2" style="margin-top: -8px">View</a>
            </div>
        </div>

        <div class="col-3">
            <div class="px-3 py-1 rounded shadow-sm border h-100">
                <div class="row gx-2 h-100">
                    <div class="col-3 d-flex align-items-center justify-content-center" style="font-size: 5rem; margin-top: -16px">
                        {{ $posts_count }}
                    </div>
                    <div class="col fs-4 text-center">
                        <div class="h-100 d-flex align-items-center text-center pb-2">New posts in the last 24 hours</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="px-3 py-1 rounded shadow-sm border h-100">
                <div class="row gx-2 h-100">
                    <div class="col-3 d-flex align-items-center justify-content-center" style="font-size: 5rem; margin-top: -16px">
                        0
                    </div>
                    <div class="col fs-4 text-center">
                        <div class="h-100 d-flex align-items-center text-center pb-2">Unmanaged registration requests</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>
