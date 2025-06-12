@extends('layouts/app')
@section('title', 'Upload new media')
@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1 class="mb-4">{{__('Upload new media')}}</h1>
        <form method="POST" action="{{ route('media.store') }}"  enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">{{__('Name')}}</label>
                <input type="text" name="name" class="form-control" value="{{old('name')}}" >
            </div>
            <div class="mb-3">
                <label class="form-label">{{__('Upload media')}}</label>
                <input type="file" name="media" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">{{__('Description')}}</label>
                <textarea name="description" class="form-control" rows="5" >{{old('description')}}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">{{__('Keywords')}}</label>
                <textarea name="keywords" class="form-control" rows="1" >{{old('keywords')}}</textarea>
            </div>
            <button type="submit" class="btn btn-success">{{__('Upload media')}}</button>
        </form>
    </div>
@endsection
