{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

<x-guest-layout>
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-5">
            <div class="card shadow rounded-2 border-0">
                <div class="card-body p-4 p-sm-5">
                    <div class="text-center mb-4">
                        <a href="index.html" class="d-block auth-logo">
                            <img src="{{ asset('backend/assets/images/logo-sm.svg') }}" alt="" height="28">
                            <span class="logo-txt">Minia</span>
                        </a>
                    </div>
                    <div class="auth-content my-auto">
                        <div class="text-center">
                            <h5 class="mb-0">Forgot Password</h5>
                        </div>
                        <div class="alert alert-success text-center my-4" role="alert">
                            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                        </div>
                        <form class="mt-4" method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email" name="email" :value="old('email')" required autofocus autocomplete="username">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="mb-3 mt-4">
                                <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">{{ __('Send Password Reset Link') }}</button>
                            </div>
                        </form>

                        <div class="mt-5 text-center">
                            <p class="text-muted mb-0">Remember It ?  <a href="{{ route('login') }}" class="text-primary fw-semibold"> Sign In </a> </p>
                        </div>
                    </div>
                </div>

                <div class="text-center pb-4">
                    <p class="mb-0 small text-muted">
                        © <script>document.write(new Date().getFullYear())</script> Minia. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

