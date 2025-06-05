<div class="card border border-secondary m-3 bg-light" style="border-radius: 3%">
    <div class="card-header d-flex justify-content-between align-items-center">
        <p class="card-title fs-3 text-dark">{{$media->name}}</p>
        <button class="btn btn-outline-secondary btn-sm p-1 btn-light" style="width: 40px; height: 40px;" id="optionsButton">
            <a href="{{route('media.show',$media->uuid)}}">
                <img src="{{asset('/assets/dots.png')}}" alt="options" style="width: 100%">
            </a>
        </button>
    </div>
    <div class="card-body">
        @if((hash_equals($media->type, 'image')))
            <img class ="img-fluid" src="{{asset("$media->route")}}" alt="preview"/>
        @else
            <img class ="img-fluid" src="{{asset("assets/placeholder.png")}}" alt="preview"/>
        @endif

        <p class="card-text text-dark">{{$media->description}}</p>
        <div id="keywords" class="d-flex flex-wrap gap-2">
            @foreach($media->keywords as $keyword)
                <span class="badge bg-primary">{{$keyword->name}}</span>
            @endforeach
        </div>
            <div class="mt-3 text-center">
            <a class="btn btn-success m-auto">Download</a>
            </div>
    </div>
</div>

