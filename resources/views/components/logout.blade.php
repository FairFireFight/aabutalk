<div>
    <form action="/logout" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-outline-light rounded-0 px-5">
            <i class="bi bi-box-arrow-left me-1"></i> {{ __('common.logout') }}
        </button>
    </form>
</div>
