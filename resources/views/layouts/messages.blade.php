@if (session('status'))
    <div class="alert alert-success">
        <div class="container">
            {{ session('status') }}
        </div>
    </div>
@endif