@extends('layouts.app')
@section('title', __('Available media'))
@section('content')
    <div class="container my-4">
        <form method="GET" action="{{route('media.index')}}">
            <div class="card shadow-sm border-0
            {{$theme === 'dark' ? 'bg-dark text-light' : 'bg-white text-dark'}}
            {{$density === 'compact' ? 'p-2' : 'p-4'}}">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        {{__('Filter by keywords')}}
                    </h5>
                    <div class="d-flex flex-wrap gap-2 align-items-center">
                        @foreach($allKeywords as $keyword)
                            @php
                                $isChecked = in_array($keyword->id, $selectedKeywords ?? []);
                                $bgClass = $isChecked
                                    ? ($theme === 'dark' ? 'bg-primary text-white' : 'bg-primary text-white')
                                    : ($theme === 'dark' ? 'bg-secondary text-light' : 'bg-light text-dark');
                                $paddingClass = $density === 'compact' ? 'px-2 py-1 small' : 'px-3 py-2';
                            @endphp
                            <div class="form-check form-check-inline rounded-pill border {{$bgClass}} {{$paddingClass}}">
                                <input class="form-check-input visually-hidden"
                                       type="checkbox"
                                       name="keywords[]"
                                       value="{{$keyword->id}}"
                                       id="keyword_{{$keyword->id}}"
                                       onchange="this.form.submit()"
                                    {{$isChecked ? 'checked' : ''}}>
                                <label class="form-check-label m-0 w-100" for="keyword_{{$keyword->id}}" style="cursor:pointer;">
                                    {{$keyword->name}}
                                </label>
                            </div>
                        @endforeach

                        @if(!empty($selectedKeywords))
                            <a href="{{route('media.index')}}"
                               class="btn btn-sm {{$theme === 'dark' ? 'btn-outline-light' : 'btn-outline-secondary'}}">
                                {{__('Clear')}}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>

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
