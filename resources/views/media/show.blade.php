@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.app')
@section('title', $media->name)
@section('content')
    <div class="container py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{session('error')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm {{$theme === 'dark' ? 'bg-dark text-light' : ''}}">
            <div class="card-body text-center">
                <h2 class="card-title mb-4">{{$media->name}}</h2>

                @php
                    $type = $media->type;
                    $mimeType = Storage::disk('private')->mimeType($media->route);
                @endphp

                @if(hash_equals($type, 'image'))
                    <img class="img-fluid rounded mb-3" src="{{route('media.preview', $media->uuid)}}" alt="preview">
                @elseif(hash_equals($type, 'text') || hash_equals($type, 'application'))
                    <iframe src="{{route('media.preview', $media->uuid)}}" width="100%"
                            height="600px"></iframe>
                @elseif(hash_equals($type, 'audio'))
                    <audio controls>
                        <source src="{{ route('media.preview', $media->uuid) }}" type="{{$mimeType}}">
                    </audio>
                @elseif(hash_equals($type, 'video'))
                    <video controls class="mb-3 w-100" style="max-height: 500px;">
                        <source src="{{ route('media.preview', $media->uuid) }}" type="{{$mimeType}}">
                    </video>
                @else
                    <img class="img-fluid rounded mb-3" src="{{asset('assets/placeholder.png')}}" alt="placeholder">
                @endif

                <div id="keywords" class="d-flex flex-wrap gap-2 justify-content-center mb-3">
                    @foreach($media->keywords as $keyword)
                        <span class="badge bg-primary">{{ $keyword->name }}</span>
                    @endforeach
                </div>

                <p class="{{$theme === 'dark' ? 'text-light' : ''}}">
                    <strong>{{__('Description')}}:</strong> {{$media->description}}
                </p>

                <ul class="list-unstyled mb-4 {{$theme === 'dark' ? 'text-light' : ''}}">
                    <li><strong>{{__('Type')}}:</strong> {{$media->type}}</li>
                    <li><strong>{{__('Extension')}}:</strong> {{pathinfo($media->route, PATHINFO_EXTENSION)}}</li>
                    <li><strong>{{__('Owner')}}:</strong> {{$media->owner}}</li>
                    <li><strong>{{__('Date')}}:</strong> {{$media->created_at?->format('Y-m-d')}}</li>
                </ul>

                <div class="d-flex gap-2 justify-content-center flex-wrap">
                    <a class="btn btn-success" href="{{route('media.download', $media->uuid)}}">{{__('Download')}}</a>
                    <a class="btn btn-primary" href="{{route('media.edit', $media->uuid)}}">{{__('Edit')}}</a>
                    <form action="{{route('media.destroy', $media)}}" method="POST"
                          onsubmit="return confirm('{{__('Are you sure you want to delete this media?')}}');" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{__('Delete')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

