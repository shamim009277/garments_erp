
<x-guest-layout :title="'Login | Garments ERP - Complete Solution for Garments Manufacturing and Management'">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-5">
            <div class="card shadow rounded-2 border-0">
                <div class="card-body p-4 p-sm-5">
                    <div class="text-center mb-4">
                        <a href="index.html" class="d-block auth-logo">
                            <img src="{{ asset('backend/assets/images/logo-sm.svg') }}" alt="" height="28">
                            <span class="logo-txt">{{ $general->short_name }}</span>
                        </a>
                    </div>
                    <div class="text-center">
                        <h5 class="mb-0">Welcome Back!</h5>
                        <p class="text-muted mt-2">Sign in to continue to {{ $general->short_name }}.</p>
                    </div>

                    <form id="actionForm" class="mt-4 pt-2" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="email">Username</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Enter username" required autofocus autocomplete="username">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <label class="form-label mb-2" for="password">Password</label>
                                <a href="{{ route('password.request') }}" class="text-primary small fw-semibold">Forgot password?</a>
                            </div>
                            <div class="input-group auth-pass-inputgroup">
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter password"
                                    aria-label="Password" required autocomplete="current-password">
                                <button class="btn btn-light shadow-none" type="button" id="password-addon">
                                    <i class="mdi mdi-eye-outline"></i>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                            <label class="form-check-label" for="remember_me">Remember me</label>
                        </div>
                        <div class="mb-3">
                            <x-primary-button type="submit" class="w-100">
                                Log In
                            </x-primary-button>
                        </div>
                    </form>
                    <div class="mt-4 text-center">
                        <p class="text-muted mb-0">
                            Don't have an account? <br>
                            <a href="#" class="text-primary fw-semibold">Unauthorized Access is Prohibited</a>
                        </p>
                    </div>
                </div>
                <x-footer-copyright />
            </div>
        </div>
    </div>
</x-guest-layout>
