<div>
    <form action="/logout" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-light rounded-pill px-4">Log Out</button>
    </form>
</div>
