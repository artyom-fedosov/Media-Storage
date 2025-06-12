@extends('layouts.app')
@section('title', __('Edit existing media'))
@section('content')
    <div class="container py-4">
        <h1 class="h4 mb-4 {{$theme === 'dark' ? 'text-light' : 'text-dark'}}">
            {{__('Edit media')}}
        </h1>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
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

            <div class="mb-3">
                <label class="form-label {{$theme === 'dark' ? 'text-light' : 'text-dark'}}">{{__('Name')}}</label>
                <input type="text" name="name"
                       class="form-control {{$theme === 'dark' ? 'bg-dark text-light border-secondary' : ''}}"
                       value="{{old('name', $media->name)}}">
            </div>

            <div class="mb-3">
                <label class="form-label {{$theme === 'dark' ? 'text-light' : 'text-dark'}}">{{__('Description')}}</label>
                <textarea name="description"
                          class="form-control {{$theme === 'dark' ? 'bg-dark text-light border-secondary' : ''}}"
                          rows="4">{{old('description', $media->description)}}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label {{$theme === 'dark' ? 'text-light' : 'text-dark'}}">{{__('Keywords')}}</label>
                <input type="text" name="keywords"
                       class="form-control {{$theme === 'dark' ? 'bg-dark text-light border-secondary' : ''}}"
                       value="{{old('keywords', $media->keywords_string)}}">
            </div>

            <button type="submit" class="btn {{$theme === 'dark' ? 'btn-light' : 'btn-success'}}">
                {{__('Save')}}
            </button>
        </form>
    </div>
@endsection
