@if ($errors->any())
    <div class="alert alert-danger">
        <div class="container">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
    </div>
@endif