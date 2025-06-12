<div class="card border border-secondary m-3 bg-light" style="border-radius: 3%; height: 100%; display: flex; flex-direction: column;">
    <div class="card-header d-flex justify-content-between align-items-center">
        <p class="card-title fs-3 text-dark">{{$media->name}}</p>
        <button class="btn btn-outline-secondary btn-sm p-1 btn-light" style="width: 40px; height: 40px;" id="optionsButton">
            <a href="{{route('media.show',$media->uuid)}}">
                <img src="{{asset('/assets/dots.png')}}" alt="options" style="width: 100%">
            </a>
        </button>
    </div>
    <div class="card-body" style="flex: 1 1 auto; display: flex; flex-direction: column;">
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

        <p class="card-text text-dark">{{$media->description}}</p>
        <div id="keywords" class="d-flex flex-wrap gap-2" style="margin-top: auto;">
            @foreach($media->keywords as $keyword)
                <span class="badge bg-primary">{{$keyword->name}}</span>
            @endforeach
        </div>
        <div class="mt-3 text-center">
            <a class="btn btn-success" href="{{route('media.download',$media->uuid)}}">{{__('Download')}}</a>
        </div>
    </div>
</div>
