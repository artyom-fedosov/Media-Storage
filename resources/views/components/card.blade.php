<div class="card m-{{$density === 'compact' ? '2' : '3'}} border {{$theme === 'dark' ? 'border-light bg-dark text-light' : 'border-secondary bg-light text-dark'}} rounded-3 h-100 d-flex flex-column">
    <div class="card-header d-flex justify-content-between align-items-center {{$density === 'compact' ? 'py-1 px-2' : ''}}">
        <p class="card-title fs-5 mb-0 {{$density === 'compact' ? 'small' : ''}}">{{$media->name}}</p>
        <a href="{{route('media.show', $media->uuid)}}"
           class="btn btn-outline-{{$theme === 'dark' ? 'light' : 'secondary'}} btn-sm {{$density === 'compact' ? 'p-1' : ''}} d-flex align-items-center justify-content-center"
           style="width: 40px; height: 40px;">
            <img src="{{asset('/assets/dots.png')}}" alt="options" class="{{$theme === 'dark' ? 'filter-invert' : ''}}" style="width: 100%;">
        </a>
    </div>
    <div class="card-body d-flex flex-column flex-grow-1 {{$density === 'compact' ? 'p-2' : 'p-3'}}">
        @php $type = $media->type; @endphp

        @if(hash_equals($type, 'image'))
            <img class="img-fluid rounded mb-{{$density === 'compact' ? '2' : '3'}}"
                 src="{{route('media.preview', $media->uuid)}}"
                 alt="preview"
                 style="max-height: 300px; object-fit: contain; width: 100%;">
        @elseif(hash_equals($type, 'text') || hash_equals($type, 'application'))
            <img class="img-fluid rounded mb-{{$density === 'compact' ? '2' : '3'}}"
                 src="{{asset('assets/document.jpg')}}"
                 alt="document preview"
                 style="max-height: 300px; object-fit: contain; width: 100%;">
        @elseif(hash_equals($type, 'audio'))
            <img class="img-fluid rounded mb-{{$density === 'compact' ? '2' : '3'}}"
                 src="{{asset('assets/audio.png')}}"
                 alt="audio preview"
                 style="max-height: 300px; object-fit: contain; width: 100%;">
        @elseif(hash_equals($type, 'video'))
            <img class="img-fluid rounded mb-{{$density === 'compact' ? '2' : '3'}}"
                 src="{{asset('assets/video.jpg')}}"
                 alt="video preview"
                 style="max-height: 300px; object-fit: contain; width: 100%;">
        @else
            <img class="img-fluid rounded mb-{{$density === 'compact' ? '2' : '3'}}"
                 src="{{asset('assets/placeholder.png')}}"
                 alt="placeholder"
                 style="max-height: 300px; object-fit: contain; width: 100%;">
        @endif

        <p class="card-text flex-grow-1 {{$density === 'compact' ? 'small mb-2' : 'mb-3'}}">{{$media->description}}</p>

        <div id="keywords" class="d-flex flex-wrap gap-2 {{$density === 'compact' ? 'mb-2' : 'mb-3'}}">
            @foreach($media->keywords as $keyword)
                <span class="badge bg-primary {{$density === 'compact' ? 'py-1 px-2' : ''}}">{{$keyword->name}}</span>
            @endforeach
        </div>

        <div class="text-center mt-auto">
            <a class="btn btn-success btn-sm {{$density === 'compact' ? 'py-1 px-2' : ''}}"
               href="{{route('media.download', $media->uuid)}}">
                {{__('Download')}}
            </a>
        </div>
    </div>
</div>
