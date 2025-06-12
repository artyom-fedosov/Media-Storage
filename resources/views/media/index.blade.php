@extends('layouts.app')
@section('title', __('Available media'))
@section('content')
    <div class="container py-{{$density === 'compact' ? '2' : '4'}}">
        <h1 class="h3 mb-{{$density === 'compact' ? '3' : '4'}} {{$theme === 'dark' ? 'text-light' : 'text-dark'}}">
            {{__('Available media')}}
        </h1>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show {{$density === 'compact' ? 'small' : ''}}" role="alert">
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($media->count())
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-{{$density === 'compact' ? '2' : '4'}}">
                @foreach($media as $mediaPiece)
                    <div class="col">
                        <x-card :media="$mediaPiece" :theme="$theme" :density="$density"/>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center mt-{{$density === 'compact' ? '3' : '5'}} fs-{{$density === 'compact' ? '6' : '5'}}
            {{$theme === 'dark' ? 'text-secondary' : 'text-muted'}}">
                {{__('No media found.')}}
            </div>
        @endif
    </div>
@endsection
