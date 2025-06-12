@extends('layouts.app')
@section('title', 'Upload new media')
@section('content')
    <div class="container mt-5">
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

        <h1 class="mb-4 {{$theme === 'dark' ? 'text-light' : 'text-dark'}}">{{__('Upload new media')}}</h1>

        <form method="POST" action="{{route('media.store')}}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label {{$theme === 'dark' ? 'text-light' : 'text-dark'}}">{{__('Name')}}</label>
                <input type="text" name="name" class="form-control {{$theme === 'dark' ? 'bg-dark text-light border-secondary' : ''}}" value="{{old('name')}}">
            </div>

            <div class="mb-3">
                <label class="form-label {{$theme === 'dark' ? 'text-light' : 'text-dark'}}">{{__('Upload media')}}</label>
                <input type="file" name="media" class="form-control {{$theme === 'dark' ? 'bg-dark text-light border-secondary' : ''}}">
            </div>

            <div class="mb-3">
                <label class="form-label {{$theme === 'dark' ? 'text-light' : 'text-dark'}}">{{__('Description')}}</label>
                <textarea name="description" class="form-control {{$theme === 'dark' ? 'bg-dark text-light border-secondary' : ''}}" rows="5">{{old('description')}}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label {{$theme === 'dark' ? 'text-light' : 'text-dark'}}">{{__('Keywords')}}</label>
                <textarea name="keywords" class="form-control {{$theme === 'dark' ? 'bg-dark text-light border-secondary' : ''}}" rows="1">{{old('keywords')}}</textarea>
            </div>

            <button type="submit" class="btn {{$theme === 'dark' ? 'btn-light' : 'btn-success'}}">{{__('Upload media')}}</button>
        </form>
    </div>
@endsection
