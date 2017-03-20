@if(session('danger'))
    <div class="alert alert-danger" role="alert">
        <ul>
            <li>{{ session('danger') }}</li>
        </ul>
    </div>
@endif