@if (session('status'))
    <div class="alert alert-{{ session('level') }}">
        {{ session('status') }}
    </div>
@endif