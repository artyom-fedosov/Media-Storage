<div class="card m-3 border {{$theme === 'dark' ? 'border-light bg-dark text-light' : 'border-secondary bg-light text-dark'}}"
     style="border-radius: 12px; height: 100%; display: flex; flex-direction: column;">
    <div class="card-header d-flex justify-content-between align-items-center">
        <p class="card-title fs-5 mb-0">{{$media->name}}</p>
        <a href="{{route('media.show', $media->uuid)}}" class="btn btn-outline-{{$theme === 'dark' ? 'light' : 'secondary'}} btn-sm p-1"
           style="width: 40px; height: 40px;">
            <img src="{{asset('/assets/dots.png')}}" alt="options" style="width: 100%; filter: {{$theme === 'dark' ? 'invert(1)' : 'none'}};">
        </a>
    </div>
    <div class="card-body d-flex flex-column" style="flex-grow: 1;">
        @php
            $type = $media->type;
        @endphp

        @if(hash_equals($type, 'image'))
            <img class="img-fluid rounded mb-3"
                 src="{{route('media.preview', $media->uuid)}}"
                 alt="preview"
                 style="max-height: 300px; width: 100%; object-fit: contain;">
        @elseif(hash_equals($type, 'text') || hash_equals($type, 'application'))
            <img class="img-fluid rounded mb-3"
                 src="{{asset('assets/document.jpg')}}"
                 alt="document preview"
                 style="max-height: 300px; width: 100%; object-fit: contain;">
        @elseif(hash_equals($type, 'audio'))
            <img class="img-fluid rounded mb-3"
                 src="{{asset('assets/audio.png')}}"
                 alt="audio preview"
                 style="max-height: 300px; width: 100%; object-fit: contain;">
        @elseif(hash_equals($type, 'video'))
            <img class="img-fluid rounded mb-3"
                 src="{{asset('assets/video.jpg')}}"
                 alt="video preview"
                 style="max-height: 300px; width: 100%; object-fit: contain;">
        @else
            <img class="img-fluid rounded mb-3"
                 src="{{asset('assets/placeholder.png')}}"
                 alt="placeholder"
                 style="max-height: 300px; width: 100%; object-fit: contain;">
        @endif

        <p class="card-text flex-grow-1">{{$media->description}}</p>

        <div id="keywords" class="d-flex flex-wrap gap-2 mb-3">
            @foreach($media->keywords as $keyword)
                <span class="badge bg-primary">{{$keyword->name}}</span>
            @endforeach
        </div>

        <div class="text-center mt-auto">
            <a class="btn btn-success" href="{{route('media.download', $media->uuid)}}">{{__('Download')}}</a>
        </div>
    </div>
</div>

