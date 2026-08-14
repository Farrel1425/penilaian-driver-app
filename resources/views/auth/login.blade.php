<x-layouts.guest title="Login Admin">
    <main class="lais-login-page">
        <section class="lais-login-card" aria-labelledby="login-title">
            <header class="lais-login-brand">
                <div class="lais-login-mark">
                    <x-lucide-shield-check aria-hidden="true" />
                </div>
                <h1>LAIS</h1>
                <p>Aplikasi Penilaian Driver dan Kendaraan</p>
            </header>

            <div class="lais-login-content">
                <div class="lais-login-intro">
                    <h2 id="login-title">Selamat Datang</h2>
                </div>

                @if ($errors->any())
                    <div class="lais-login-alert" role="alert">
                        <x-lucide-circle-alert aria-hidden="true" />
                        <p>{{ $errors->first('email') ?: $errors->first('password') }}</p>
                    </div>
                @endif

                <form class="lais-login-form" method="POST" action="{{ route('login.store') }}">
                    @csrf

                    <label class="lais-login-field">
                        <span>Email</span>
                        <div class="lais-login-input-wrap">
                            <x-lucide-user-round class="lais-login-input-icon" aria-hidden="true" />
                            <input name="email" type="email" value="{{ old('email') }}" autocomplete="email" placeholder="Masukkan email" required autofocus>
                        </div>
                    </label>

                    <label class="lais-login-field">
                        <span>Password</span>
                        <div class="lais-login-input-wrap">
                            <x-lucide-lock-keyhole class="lais-login-input-icon" aria-hidden="true" />
                            <input name="password" type="password" autocomplete="current-password" placeholder="Masukkan password" required data-password-input>
                            <button class="lais-login-password-toggle" type="button" aria-label="Tampilkan password" aria-pressed="false" data-password-toggle>
                                <x-lucide-eye-off data-password-icon="hidden" aria-hidden="true" />
                                <x-lucide-eye data-password-icon="visible" aria-hidden="true" />
                            </button>
                        </div>
                    </label>

                    <button class="lais-login-submit" type="submit">
                        <span>Masuk</span>
                        <x-lucide-arrow-right aria-hidden="true" />
                    </button>
                </form>

                <footer class="lais-login-footer">&copy; {{ now()->year }} LAIS Driver &amp; Kendaraan</footer>
            </div>
        </section>
    </main>
</x-layouts.guest>
