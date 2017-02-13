@if(session('warning'))
    <div class="alert alert-warning" role="alert">
        <ul>
            <li>{{ session('warning') }}</li>
        </ul>
    </div>
@endif