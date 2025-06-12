@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 {{$theme === 'dark' ? 'text-light' : 'text-dark'}}">{{__('Settings')}}</h2>

        <form method="POST">
            @csrf

            <div class="mb-3">
                <label for="theme" class="form-label {{$theme === 'dark' ? 'text-light' : 'text-dark'}}">{{__('Theme')}}</label>
                <select name="theme" id="theme" class="form-select {{$theme === 'dark' ? 'bg-dark text-light' : ''}}">
                    <option value="light">{{__('Light')}}</option>
                    <option value="dark">{{__('Dark')}}</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="density" class="form-label {{$theme === 'dark' ? 'text-light' : 'text-dark'}}">{{__('Density')}}</label>
                <select name="density" id="density" class="form-select {{$theme === 'dark' ? 'bg-dark text-light' : ''}}">
                    <option value="comfortable">{{__('Comfortable')}}</option>
                    <option value="compact">{{__('Compact')}}</option>
                </select>
            </div>

            <button type="submit" class="btn {{$theme === 'dark' ? 'btn-light' : 'btn-primary'}}">{{__('Save')}}</button>
        </form>
    </div>
@endsection
