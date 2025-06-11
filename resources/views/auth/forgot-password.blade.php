
<x-guest-layout>
    @slot('title', 'Forget Password')
    <div class="authentication-forgot d-flex align-items-center justify-content-center">
        <div class="card forgot-box">
            <div class="card-body">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="p-4 rounded  border">
                        <div class="text-center">
                            <img src="{{ asset('backend/assets/images/icons/forgot-2.png') }}" width="100" alt="" />
                        </div>
                        <h4 class="mt-5 font-weight-bold">Forgot Password?</h4>
                        <p class="text-muted">Enter your registered email ID to reset the password</p>
                        <div class="my-4">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" placeholder="example@user.com" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Send</button> <a
                                href="{{ route('login') }}" class="btn btn-light"><i
                                    class='bx bx-arrow-back me-1'></i>Back to Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>