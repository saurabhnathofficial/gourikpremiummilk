@extends('layouts.app')

@section('title', 'Login | Gourik Premium Milk')

@section('content')

<div class="gourik-login-page">

    <div class="container">
        <div class="row justify-content-center align-items-center">

            <div class="col-12 col-md-8 col-lg-5">

                <div class="gourik-login-card">

                    {{-- Logo --}}
                    <div class="text-center mb-4">
                        <a href="{{ route('home') }}">
                            <img
                                src="{{ asset('images/gourik_logo.png') }}"
                                alt="Gourik Premium Milk"
                                class="gourik-login-logo">
                        </a>
                    </div>

                    <div class="text-center mb-4">
                        <h1>Welcome Back</h1>
                        <p>Login to your Gourik account</p>
                    </div>

                    {{-- Session Status --}}
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Email / Farmer ID --}}
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">
                                Farmer ID
                            </label>

                            <input
                                id="email"
                                type="text"
                                name="email"
                                class="form-control"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="Enter your Farmer ID">

                            @if ($errors->get('email'))
                            <div class="text-danger small mt-1">
                                {{ $errors->first('email') }}
                            </div>
                            @endif
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                Password
                            </label>

                            <input
                                id="password"
                                type="password"
                                name="password"
                                class="form-control"
                                required
                                autocomplete="current-password">

                            @error('password')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- Remember Me --}}
                        <div class="form-check mb-4">
                            <input
                                id="remember_me"
                                type="checkbox"
                                name="remember"
                                class="form-check-input">

                            <label
                                for="remember_me"
                                class="form-check-label">
                                Remember me
                            </label>
                        </div>

                        {{-- Login --}}
                        <button
                            type="submit"
                            class="btn gourik-login-btn w-100">
                            Login
                        </button>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection