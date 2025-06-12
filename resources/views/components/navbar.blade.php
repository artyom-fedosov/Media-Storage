<nav class="navbar navbar-expand-md {{$theme === 'dark' ? 'bg-dark navbar-dark' : 'bg-light navbar-light'}} shadow-sm py-3">
    <div class="container-fluid d-flex flex-wrap align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3">
            @auth
                <a class="btn {{$theme === 'dark' ? 'btn-outline-light' : 'btn-outline-dark'}}"
                   href="{{ route('media.index') }}">{{__('Media Storage')}}</a>
                <a class="btn {{$theme === 'dark' ? 'btn-outline-light' : 'btn-outline-dark'}}"
                   href="{{ route('media.create') }}">{{__('Upload Media')}}</a>
            @endauth
        </div>

        <div class="d-flex align-items-center gap-3">
            @guest
                <a class="btn {{ $theme === 'dark' ? 'btn-light' : 'btn-secondary' }}"
                   href="{{route('showLogin')}}">{{__('Log in')}}</a>
                <a class="btn {{$theme === 'dark' ? 'btn-outline-light' : 'btn-outline-dark'}}"
                   href="{{route('showRegister') }}">{{ __('Sign up')}}</a>
            @endguest

            @auth
                <span class="{{$theme === 'dark' ? 'text-white' : 'text-dark'}} fw-bold">{{$username}}</span>

                <a class="btn {{$theme === 'dark' ? 'btn-outline-light' : 'btn-outline-dark'}}" href="{{route('settings')}}">
                    <img src="{{asset('/assets/settings.png')}}" alt="settings" style="width:32px; height:32px;">
                </a>

                <a class="btn {{$theme === 'dark' ? 'btn-light' : 'btn-secondary'}}" href="{{route('logout')}}">{{__('Logout')}}</a>
            @endauth

            <div class="dropdown">
                <button class="btn {{$theme === 'dark' ? 'btn-outline-light' : 'btn-outline-dark'}} dropdown-toggle"
                        type="button" data-bs-toggle="dropdown">
                    {{$lang}}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="/language/en">English</a></li>
                    <li><a class="dropdown-item" href="/language/lv">Latviešu</a></li>
                    <li><a class="dropdown-item" href="/language/ru">Русский</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

