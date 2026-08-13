@if (session('status'))
    <div class="flash-message">{{ session('status') }}</div>
@endif