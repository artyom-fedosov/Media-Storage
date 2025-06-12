@extends('layouts.app')
@section('title', __('Available media'))
@section('content')
    <div class="container py-4">
        <h1 class="h3 mb-4">
            {{__('Available media')}}
        </h1>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($media->count())
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                @foreach($media as $mediaPiece)
                    <div class="col">
                        <x-card :media="$mediaPiece"/>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center mt-5 fs-5 {{$theme === 'dark' ? 'text-secondary' : 'text-muted'}}">
                {{__('No media found.')}}
            </div>
        @endif
    </div>
@endsection


