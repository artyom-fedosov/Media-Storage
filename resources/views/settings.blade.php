@extends('layouts.app')
@section('content')
    <div class="container mt-5 {{$density === 'compact' ? 'p-2' : 'p-4'}}">
        <h2 class="mb-4 {{$theme === 'dark' ? 'text-light' : 'text-dark'}}">{{__('Settings')}}</h2>

        <form method="POST">
            @csrf

            <div class="mb-{{$density === 'compact' ? '2' : '3'}}">
                <label for="theme" class="form-label {{$theme === 'dark' ? 'text-light' : 'text-dark'}}">
                    {{__('Theme')}}
                </label>
                <select name="theme" id="theme" class="form-select {{$theme === 'dark' ? 'bg-dark text-light' : ''}} {{$density === 'compact' ? 'form-select-sm' : ''}}">
                    <option value="light" {{$theme === 'light' ? 'selected' : ''}}>{{__('Light')}}</option>
                    <option value="dark" {{$theme === 'dark' ? 'selected' : ''}}>{{__('Dark')}}</option>
                </select>
            </div>

            <div class="mb-{{$density === 'compact' ? '2' : '3'}}">
                <label for="density" class="form-label {{$theme === 'dark' ? 'text-light' : 'text-dark'}}">
                    {{__('Density')}}
                </label>
                <select name="density" id="density" class="form-select {{$theme === 'dark' ? 'bg-dark text-light' : ''}} {{$density === 'compact' ? 'form-select-sm' : ''}}">
                    <option value="comfortable" {{$density === 'comfortable' ? 'selected' : ''}}>{{__('Comfortable')}}</option>
                    <option value="compact" {{$density === 'compact' ? 'selected' : ''}}>{{__('Compact')}}</option>
                </select>
            </div>

            <button type="submit" class="btn {{$theme === 'dark' ? 'btn-light' : 'btn-primary'}} {{$density === 'compact' ? 'btn-sm' : ''}}">
                {{__('Save')}}
            </button>
        </form>
    </div>
@endsection
