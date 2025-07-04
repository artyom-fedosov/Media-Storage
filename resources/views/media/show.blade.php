@php use App\Models\User;use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.app')
@section('title', $media->name)
@section('content')
    <div class="container py-{{$density === 'compact' ? '3' : '4'}}">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show {{$density === 'compact' ? 'small' : ''}}"
                 role="alert">
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show {{$density === 'compact' ? 'small' : ''}}"
                 role="alert">
                {{session('error')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm {{$theme === 'dark' ? 'bg-dark text-light' : ''}}">
            <div class="card-body text-center {{$density === 'compact' ? 'small' : ''}}">
                <h2 class="card-title mb-{{$density === 'compact' ? '3' : '4'}}">{{$media->name}}</h2>

                @php
                    $type = $media->type;
                    $mimeType = Storage::disk('private')->mimeType($media->route);
                @endphp

                @if(hash_equals($type, 'image'))
                    <img class="img-fluid rounded mb-{{$density === 'compact' ? '2' : '3'}}"
                         src="{{route('media.preview', $media->uuid)}}" alt="preview">
                @elseif(hash_equals($type, 'text') || hash_equals($type, 'application'))
                    <iframe src="{{route('media.preview', $media->uuid)}}" width="100%"
                            height="{{$density === 'compact' ? '400px' : '600px'}}"></iframe>
                @elseif(hash_equals($type, 'audio'))
                    <audio controls class="mb-{{$density === 'compact' ? '2' : '3'}}">
                        <source src="{{ route('media.preview', $media->uuid) }}" type="{{$mimeType}}">
                    </audio>
                @elseif(hash_equals($type, 'video'))
                    <video controls class="mb-{{$density === 'compact' ? '2' : '3'}} w-100"
                           style="max-height: {{$density === 'compact' ? '300px' : '500px'}};">
                        <source src="{{ route('media.preview', $media->uuid) }}" type="{{$mimeType}}">
                    </video>
                @else
                    <img class="img-fluid rounded mb-{{$density === 'compact' ? '2' : '3'}}"
                         src="{{asset('assets/placeholder.png')}}" alt="placeholder">
                @endif

                <div id="keywords"
                     class="d-flex flex-wrap gap-2 justify-content-center mb-{{$density === 'compact' ? '2' : '3'}}">
                    @foreach($media->keywords as $keyword)
                        <span class="badge bg-primary">{{$keyword->name}}</span>
                    @endforeach
                </div>

                <p class="{{$theme === 'dark' ? 'text-light' : ''}}">
                    <strong>{{__('Description')}}:</strong> {{$media->description}}
                </p>

                <ul class="list-unstyled mb-{{$density === 'compact' ? '3' : '4'}} {{$theme === 'dark' ? 'text-light' : ''}} {{$density === 'compact' ? 'small' : ''}}">
                    <li><strong>{{__('Type')}}:</strong> {{$media->type}}</li>
                    <li><strong>{{__('Extension')}}:</strong> {{pathinfo($media->route, PATHINFO_EXTENSION)}}</li>
                    <li><strong>{{__('Owner')}}:</strong> {{$media->owner}}</li>
                    <li><strong>{{__('Date')}}:</strong> {{$media->created_at?->format('Y-m-d')}}</li>
                </ul>

                <div class="d-flex gap-2 justify-content-center flex-wrap">
                    <a class="btn btn-success {{$density === 'compact' ? 'btn-sm' : ''}}"
                       href="{{route('media.download', $media->uuid)}}">{{__('Download')}}</a>
                    <a class="btn btn-primary {{$density === 'compact' ? 'btn-sm' : ''}}"
                       href="{{route('media.edit', $media->uuid)}}">{{__('Edit')}}</a>
                </div>

                @php
                    $user = auth()->user();
                    $canDelete = $user && (
                        strtolower($user->role) === 'admin' ||
                        $user->login === $media->owner
                    );
                @endphp

                @if($canDelete)
                    <form action="{{route('media.destroy', $media->uuid)}}" method="POST" class="mt-3 d-inline-block m-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="btn btn-danger {{$density === 'compact' ? 'btn-sm' : ''}}"
                                onclick="return confirm('{{ __('Are you sure you want to delete this media?') }}')">
                            {{__('Delete')}}
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
