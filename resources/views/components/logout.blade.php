<div>
    <form action="/logout" method="POST" class="px-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-outline-aabu rounded-0 w-100 px-5">
            <i class="bi bi-box-arrow-left me-1"></i> {{ __('common.logout') }}
        </button>
    </form>
</div>
