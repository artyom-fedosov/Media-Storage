@extends('layouts/app')
@section('title', $media->name)
@section('content')
    <div class="card mb-3 shadow-sm">
        <div class="card-body text-center">
            <h2 class="card-title">{{ $media->name }}</h2>
            @if((hash_equals($media->type, 'image')))
                <img class ="img-fluid" src="{{route('media.preview', $media->uuid)}}" alt="preview"/>
            @elseif((hash_equals($media->type, 'text')) or (hash_equals($media->type, 'application')))
                <img class ="img-fluid" src="{{asset("assets/document.jpg")}}" alt="preview"/>
            @elseif((hash_equals($media->type, 'audio')))
                <img class ="img-fluid" src="{{asset("assets/audio.png")}}" alt="preview"/>
            @elseif((hash_equals($media->type, 'video')))
                <img class ="img-fluid" src="{{asset("assets/video.jpg")}}" alt="preview"/>
            @else
                <img class ="img-fluid" src="{{asset("assets/placeholder.png")}}" alt="preview"/>
            @endif
            <div id="keywords" class="d-flex flex-wrap gap-2 justify-content-center">
              @foreach($media->keywords as $keyword)
                  <span class="badge bg-primary">{{$keyword->name}}</span>
              @endforeach
            </div>
            <p class="card-text"><strong>{{__('Description')}}: </strong>{{$media->description}}</p>
            <ul class="list-unstyled mb-3">
                <li><strong>{{__('Type')}}: </strong>{{$media->type}}</li>
                <li><strong>{{__('Extension')}}: </strong>{{pathinfo($media->route, PATHINFO_EXTENSION)}}</li>
                <li><strong>{{__('Owner')}}: </strong>{{$media->owner}}</li>
                <li><strong>{{__('Date')}}: </strong>{{$media->created_at?->format('Y-m-d')}}</li>
            </ul>
                <div class="d-flex gap-2 align-middle justify-content-center">
                        <a class="btn btn-success" href="{{route('media.download',$media->uuid)}}">{{__('Download')}}</a>
                        <a href="{{route('media.edit',$media->uuid)}}" class="btn btn-primary">{{__('Edit')}}</a>
                        <form action="{{ route('media.destroy', $media) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job listing?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">{{__('Delete')}}</button>
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
