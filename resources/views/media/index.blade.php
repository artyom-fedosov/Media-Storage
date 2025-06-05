@extends('layouts/app')
@section('title', 'Available media')
@section('content')
    <h1 class="container">Available media</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($media->count())
        <div class="container d-grid" style="display: grid; grid-template-columns: 1fr 1fr 1fr;">
            @foreach($media as $mediaPiece)
            <x-card :media="$mediaPiece"/>
            @endforeach
        </div>
    @else
        <p>No media found.</p>
    @endif
@endsection
