@extends('layouts.app')
@section('title', 'User')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'User',
                'subtitle' => 'Profile',
                'breadcrumbs' => [
                    ['label' => 'User', 'url' => '#'],
                    ['label' => 'Profile'],
                ],
            ])
        </div>
        <div class="col-md-12 pe-md-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2 py-3">
                    <h6 class="my-0 text-primary d-flex align-items-center gap-2">
                        <i data-feather="user" width="16" height="16"></i>
                        User Profile
                    </h6>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-primary d-flex align-items-center">
                            <i data-feather="arrow-left" width="12" height="12" class="me-1"></i> Back
                        </a>
                        <button type="button" class="btn btn-sm btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#updatePasswordModal">
                            <i data-feather="lock" width="12" height="12" class="me-1"></i> Change Password
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 pe-md-0 mb-3">
                            <div class="d-flex flex-column align-items-center justify-content-center border border-primary p-4 mt-3 mt-sm-0 text-center">
                                <div class="avatar-xl mb-3">
                                    <img src="{{ asset('backend/assets/images/users/avatar-1.jpg') }}" alt="User Avatar" class="img-fluid rounded-circle d-block">
                                </div>

                                <div>
                                    <h5 class="font-size-16 mb-1">User Name: {{ Auth::user()->name }}</h5>
                                    <h6 class="font-size-16 mb-1">Employee ID: {{ Auth::user()->employee_id }}</h6>
                                    <p class="text-muted font-size-13 mb-2">Email: {{ Auth::user()->email }}</p>

                                    <div class="d-flex flex-wrap justify-content-center align-items-center gap-2 gap-lg-3 text-muted font-size-13">
                                        <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Assign Role: {{ Auth::user()->role->name }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="d-flex align-items-start mt-3 mt-sm-0 border border-info p-3 overflow-auto">
                                {{-- {{ Auth::user()->role->permissions }} --}}
                            </div>
                        </div>
                    </div>
                </div>


                <div id="updatePasswordModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="myModalLabel">Update Password</h6>
                                <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <form id="updatePasswordForm" action="{{ route('user.profile.update') }}" method="POST">
                                <div class="modal-body">
                                    @csrf
                                    @method('PATCH')
                                    <div class="alert alert-danger" role="alert">
                                        {{ __('Ensure your account is using a long, random password to stay secure.') }}
                                    </div>

                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">Current Password <span class="text-danger">*</span></label>
                                        <input type="password"class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" placeholder="Enter current password" required>
                                        <x-input-error :messages="$errors->get('current_password')" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">New Password <span class="text-danger">*</span></label>
                                        <input type="password"class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter new password" required>
                                        <x-input-error :messages="$errors->get('password')" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password"class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password" required>
                                        <x-input-error :messages="$errors->get('password_confirmation')" />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary waves-effect btn-sm" data-bs-dismiss="modal">Close</button>
                                    <x-primary-button id="submitBtn" class="float-start btn-sm submitBtn">Save changes</x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
