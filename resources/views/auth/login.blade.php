@extends('layouts/app')
@section('title', 'Log in')
@section('content')
    <div class="container">
        <form action="{{route('login')}}" method="POST" novalidate>
            @csrf
            @if(session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif
            <div class="mb-3">
                <label for="login" class="form-label">{{__('Login')}}</label>
                <input type="text" name="login" class="form-control" required
                       value="{{ old('login') }}">
                @error('login') <small class="text-danger">{{$message}}</small> @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">{{__('Password')}}</label>
                <input type="password" name="password" class="form-control" required>
                @error('password') <small class="text-danger">{{$message}}</small> @enderror
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">{{__('Log in')}}</button>
            </div>
        </form>
    </div>
@endsection
