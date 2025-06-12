@extends('layouts.app')
@section('title', 'Upload new media')
@section('content')
    <div class="container mt-{{ $density === 'compact' ? '3' : '5' }}">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show {{$density === 'compact' ? 'small' : ''}}" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h1 class="mb-4 {{$theme === 'dark' ? 'text-light' : 'text-dark'}}">{{__('Upload new media')}}</h1>

        <form method="POST" action="{{route('media.store')}}" enctype="multipart/form-data">
            @csrf

            <div class="mb-{{$density === 'compact' ? '2' : '3'}}">
                <label class="form-label {{$theme === 'dark' ? 'text-light' : 'text-dark'}}">{{__('Name')}}</label>
                <input type="text" name="name"
                       class="form-control {{$theme === 'dark' ? 'bg-dark text-light border-secondary' : ''}} {{$density === 'compact' ? 'form-control-sm' : ''}}"
                       value="{{old('name')}}">
            </div>

            <div class="mb-{{$density === 'compact' ? '2' : '3'}}">
                <label class="form-label {{$theme === 'dark' ? 'text-light' : 'text-dark'}}">{{__('Upload media')}}</label>
                <input type="file" name="media"
                       class="form-control {{$theme === 'dark' ? 'bg-dark text-light border-secondary' : ''}} {{$density === 'compact' ? 'form-control-sm' : ''}}">
            </div>

            <div class="mb-{{$density === 'compact' ? '2' : '3'}}">
                <label class="form-label {{$theme === 'dark' ? 'text-light' : 'text-dark'}}">{{__('Description')}}</label>
                <textarea name="description" rows="5"
                          class="form-control {{$theme === 'dark' ? 'bg-dark text-light border-secondary' : ''}} {{$density === 'compact' ? 'form-control-sm' : ''}}">{{old('description')}}</textarea>
            </div>

            <div class="mb-{{$density === 'compact' ? '2' : '3'}}">
                <label class="form-label {{$theme === 'dark' ? 'text-light' : 'text-dark'}}">{{__('Keywords')}}</label>
                <textarea name="keywords" rows="1"
                          class="form-control {{$theme === 'dark' ? 'bg-dark text-light border-secondary' : ''}} {{$density === 'compact' ? 'form-control-sm' : ''}}">{{old('keywords')}}</textarea>
            </div>

            <button type="submit" class="btn {{$theme === 'dark' ? 'btn-light' : 'btn-success'}} {{$density === 'compact' ? 'btn-sm' : ''}}">
                {{__('Upload media')}}
            </button>
        </form>
    </div>
@endsection
