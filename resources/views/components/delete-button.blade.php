<form action="{{ $action }}" method="POST">
    @csrf
    @method('DELETE')
    <button class="btn fs-5 text-danger rounded-0 py-0 px-0"><i class="bi bi-trash"></i></button>
</form>
