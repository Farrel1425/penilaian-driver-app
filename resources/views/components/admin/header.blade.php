@props(['title' => 'Dashboard'])

<header class="admin-header">
    <button class="icon-button mobile-menu-button" type="button" data-sidebar-toggle aria-label="Buka menu admin">
        <span aria-hidden="true">&equiv;</span>
    </button>

    <div>
        <p class="eyebrow">Admin</p>
        <h1>{{ $title }}</h1>
    </div>

    <div class="header-user">
        <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
        <div>
            <p>{{ auth()->user()->name ?? 'Admin' }}</p>
            <span>{{ auth()->user()->email ?? '' }}</span>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-button" type="submit">Logout</button>
        </form>
    </div>
</header>
