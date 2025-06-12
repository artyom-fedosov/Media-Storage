@extends('layouts/app')
@section('title', 'Sign up')
@section('content')
    <div class="container">
        <x-slot name="title">
            Sign up
        </x-slot>
        <form action="{{ route('register') }}" method="POST" novalidate>
            @csrf
            <div class="mb-3">
                <label for="login" class="form-label">{{__('Login')}}</label>
                <input type="text" name="login" class="form-control" required
                       value="{{ old('login') }}">
                @error('login') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">{{__('Full Name')}}</label>
                <input type="text" name="name" class="form-control" required
                       value="{{ old('name') }}">
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">{{__('Email Address')}}</label>
                <input type="email" name="email" class="form-control" required
                       value="{{ old('email') }}">
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">{{__('Password')}}</label>
                <input type="password" name="password" class="form-control" required>
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation " class="form-label">{{__('Confirm Password')}}</label>
                <input type="password" name="password_confirmation" class="form-control" required>
                @error('password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">{{__('Sign up')}}</button>
            </div>
        </form>
    </div>
@endsection
