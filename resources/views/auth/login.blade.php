<x-layouts.guest title="Login Admin">
    <main class="login-page">
        <section class="login-panel">
            <div class="login-brand">
                <div class="brand-mark">PD</div>
                <div>
                    <p class="brand-title">Penilaian</p>
                    <p class="brand-subtitle">Driver & Kendaraan</p>
                </div>
            </div>

            <div class="login-copy">
                <p class="eyebrow">Admin Area</p>
                <h1>Masuk ke sistem penilaian</h1>
                <p>Kelola fondasi aplikasi, master data, dan penilaian dari area admin.</p>
            </div>

            <form class="auth-form" method="POST" action="{{ route('login.store') }}">
                @csrf

                <label>
                    <span>Email</span>
                    <input name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus>
                    @error('email')
                        <small>{{ $message }}</small>
                    @enderror
                </label>

                <label>
                    <span>Password</span>
                    <input name="password" type="password" autocomplete="current-password" required>
                    @error('password')
                        <small>{{ $message }}</small>
                    @enderror
                </label>

                <label class="checkbox-field">
                    <input name="remember" type="checkbox" value="1">
                    <span>Ingat saya</span>
                </label>

                <button class="primary-button" type="submit">Masuk</button>
            </form>
        </section>
    </main>
</x-layouts.guest>
