@extends('layouts.guest')

@section('title', 'Login')

@section('content')

<x-card-shadow-center>
    <h1 class="text-center"><strong>Login</strong></h1>
    @error('not-found')
        <div class="alert alert-danger mt-3">{{ $message }}</div>
    @enderror
    <form method="POST" action="{{ route('login') }}" class="m-0">
        @csrf
        <x-form-input label="Email" name="email" id="InputEmail" type="email" name="email" value=" {{ old('email') }}" />
        <x-form-input label="Password" name="password" id="InputPassword" type="password" name="password" />
        <div class="mb-3">
            <p>Don't have an account? <a href="{{ route('register') }}">register</a></p>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</x-card-shadow-center>

@endsection