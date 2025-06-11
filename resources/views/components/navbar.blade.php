<nav class="navbar navbar-expand-md bg-secondary ">
    <div class="container-fluid justify-content-evenly">
        @guest
            <a class="navbar-text  fs-1 text-dark  mb-0" href="{{route('showLogin')}}">Log in</a>
            <a class="navbar-text  fs-1 text-dark  mb-0" href="{{route('showRegister')}}">Sign up</a>
        @endguest
        @auth
            <a class="btn btn-secondary h1 fs-1 text-dark  mb-0" href="{{route('media.index')}}">{{__('Media Storage')}}</a>
            <a class="btn btn-secondary   fs-1 text-dark  mb-0" href="{{route('media.create')}}">{{__('Upload Media')}}</a>
            <p class="navbar-text  fs-1 text-dark  mb-0">{{$username}}</p>
            <button class="btn btn-secondary" id="settingsButton" >
                <img src="{{asset('/assets/settings.png')}}" class="img-fluid" style="width:50px; height:50px"alt="settings">
            </button>
            <a class="navbar-text  fs-1 text-dark  mb-0" href="{{route('logout')}}">Logout</a>
        @endauth
        <div class="dropdown" id="languageMenu">
            <button class="btn btn-secondary dropdown-toggle text-dark fs-1" data-bs-toggle="dropdown" type="button" id="languageDropdownButton">{{$lang}}</button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" data-lang="English">English</a></li>
                <li><a class="dropdown-item" data-lang="Latviešu">Latviešu</a></li>
                <li><a class="dropdown-item" data-lang="Русский">Русский</a></li>
            </ul>
        </div>
    </div>
</nav>
