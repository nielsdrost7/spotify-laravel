@extends('layouts.auth') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group">
                <div class="card p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="card-body">
                            <h1>Login</h1>
                            <p class="text-muted">Sign In to your account</p>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-1 w-1"
                                            width="20"
                                            height="20"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"
                                            />
                                            <path
                                                d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"
                                            />
                                        </svg>
                                    </span>
                                </div>
                                <input
                                    id="email"
                                    type="email"
                                    class="
                                        form-control
                                        @error('email')
                                        is-invalid
                                        @enderror
                                    "
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="email"
                                    placeholder="email"
                                />

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-1 w-1"
                                            width="20"
                                            height="20"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z"
                                            />
                                        </svg>
                                    </span>
                                </div>
                                <input
                                    id="password"
                                    type="password"
                                    class="
                                        form-control
                                        @error('password')
                                        is-invalid
                                        @enderror
                                    "
                                    name="password"
                                    required
                                    autocomplete="new-password"
                                    placeholder="password"
                                />

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <button
                                        class="btn btn-primary px-4"
                                        type="submit"
                                    >
                                        Login
                                    </button>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="/password/reset">
                                        <button
                                            class="btn btn-link px-0"
                                            type="button"
                                        >
                                            Forgot password?
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div
                    class="card text-white bg-primary py-5 d-md-down-none"
                    style="width: 44%"
                >
                    <div class="card-body text-center">
                        <div>
                            <h2>Sign up</h2>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur
                                adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua.
                            </p>
                            <a href="/register">
                                <button
                                    class="btn btn-primary active mt-3"
                                    type="button"
                                >
                                    Register Now!
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
