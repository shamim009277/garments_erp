
<x-guest-layout>
    @slot('title', 'Login')
    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                <div class="col mx-auto">
                    <div class="mb-4 text-center">
                        <img src="{{ asset('backend/assets/images/logo-img.png') }}" width="180" alt="" />
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="text-center">
                                    <h3 class="">Sign in</h3>
                                    <p>Don't have an account yet? <a href="authentication-signup.html">Sign up here</a></p>
                                </div>

                                <div class="login-separater text-center mb-4"> <span>SIGN IN WITH EMAIL</span>
                                    <hr />
                                </div>
                                <div class="form-body">
                                    <form class="row g-3" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="col-12">
                                            <label for="Email" class="form-label">Email Address</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="Email" name="email" placeholder="Email Address" value="{{ old('email') }}" required autofocus autocomplete="username" />
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                        <div class="col-12">
                                            <label for="Password" class="form-label">Enter Password</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" class="form-control border-end-0 @error('password') is-invalid @enderror" id="Password" name="password" value="{{ old('password') }}" placeholder="Enter Password" required autocomplete="current-password" />
                                                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="remember_me" name="remember" checked>
                                                <label class="form-check-label" for="remember_me">RememberMe</label>
                                            </div>
                                        </div>
                                        @if (Route::has('password.request'))
                                        <div class="col-md-6 text-end"> 
                                            <a href="{{ route('password.request') }}">Forgot Password ?</a>
                                        </div>
                                        @endif
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Sign in</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
</x-guest-layout>