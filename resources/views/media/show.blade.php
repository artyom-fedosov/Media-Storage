@extends('layouts/app')
@section('title', $media->name)
@section('content')
    <div class="card mb-3 shadow-sm">
        <div class="card-body text-center">
            <h2 class="card-title">{{ $media->name }}</h2>
            @if((hash_equals($media->type, 'image')))
                <img class ="img-fluid" style="max-width: 600px; max-height: 400px; object-fit: contain;" src="{{asset("$media->route")}}" alt="preview"/>
            @else
                <img class ="img-fluid" style="max-width: 600px; max-height: 400px; object-fit: contain;" src="{{asset("assets/placeholder.png")}}" alt="preview"/>
            @endif
            <p class="card-text">{{ $media->description }}</p>
            <div id="keywords" class="d-flex flex-wrap gap-2 justify-content-center">
                @foreach($media->keywords as $keyword)
                    <span class="badge bg-primary">{{$keyword->name}}</span>
                @endforeach
            </div>
            <ul class="list-unstyled mb-3">
                <li><strong>Type:</strong> {{ $media->type}}</li>
                <li><strong>Owner:</strong> {{ $media->owner}}</li>
                <li><strong>Date:</strong> {{ $media->created_at?->format('Y-m-d')}}</li>
            </ul>
                <div class="d-flex gap-2 align-middle justify-content-center">
                        <a class="btn btn-success">Download</a>
                        <a href="{{route('media.edit',$media->uuid)}}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('media.destroy', $media) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job listing?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                </div>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
@endsection
