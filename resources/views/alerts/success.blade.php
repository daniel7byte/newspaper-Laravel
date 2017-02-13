@if(session('success'))
    <div class="alert alert-success" role="alert">
        <ul>
            <li>{{ session('success') }}</li>
        </ul>
    </div>
@endif