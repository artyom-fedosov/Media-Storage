@extends('layouts.app')
@section('title', __('Edit existing media'))
@section('content')
    <div class="container py-4 {{$density === 'compact' ? 'p-2' : 'p-4'}}">
        <h1 class="h4 mb-4 {{$theme === 'dark' ? 'text-light' : 'text-dark'}}">
            {{__('Edit media')}}
        </h1>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0 {{$density === 'compact' ? 'small' : ''}}">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form method="POST" action="{{route('media.update', $media->uuid)}}">
            @csrf
            @method('PUT')

            <div class="mb-{{$density === 'compact' ? '2' : '3'}}">
                <label class="form-label {{$theme === 'dark' ? 'text-light' : 'text-dark'}}">{{__('Name')}}</label>
                <input type="text" name="name" class="form-control {{$density === 'compact' ? 'form-control-sm' : ''}}"
                       value="{{old('name', $media->name)}}">
            </div>

            <div class="mb-{{$density === 'compact' ? '2' : '3'}}">
                <label class="form-label {{$theme === 'dark' ? 'text-light' : 'text-dark'}}">{{__('Description')}}</label>
                <textarea name="description" class="form-control {{$density === 'compact' ? 'form-control-sm' : ''}}" rows="4">{{old('description', $media->description)}}</textarea>
            </div>

            <div class="mb-{{$density === 'compact' ? '2' : '3'}}">
                <label class="form-label {{$theme === 'dark' ? 'text-light' : 'text-dark'}}">{{__('Keywords')}}</label>
                <input type="text" name="keywords" class="form-control {{$density === 'compact' ? 'form-control-sm' : ''}}"
                       value="{{old('keywords', $media->keywords_string)}}">
            </div>

            <button type="submit" class="btn {{$theme === 'dark' ? 'btn-light' : 'btn-success'}} {{$density === 'compact' ? 'btn-sm' : ''}}">
                {{__('Save')}}
            </button>
        </form>
        @php
        $user = auth()->user();
        $statement = ($user->login === $media->owner || $user->role === "admin");
        @endphp
        @if($statement)
            <form action="{{route('media.share', $media->uuid) }}" method="POST" class="mt-4 d-flex gap-2 align-items-center">
                @csrf
                <input
                    type="text"
                    name="user_login"
                    class="form-control"
                    placeholder="{{__('Enter user login to share with')}}"
                    required
                >
                <button type="submit" class="btn btn-primary">{{__('Share')}}</button>
            </form>

            @if(session('share_error'))
                <div class="alert alert-danger mt-2">{{session('share_error')}}</div>
            @endif

            @if(session('share_success'))
                <div class="alert alert-success mt-2">{{session('share_success')}}</div>
            @endif
        @endif
    </div>
@endsection
