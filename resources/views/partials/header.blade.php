<header class="app-header navbar">
    <button
        class="navbar-toggler sidebar-toggler d-lg-none mr-auto"
        data-toggle="sidebar-show"
        type="button"
    >
        <span class="navbar-toggler-icon"> </span>
    </button>

    <a class="navbar-brand" href="#">
        <img
            class="navbar-brand-full"
            src="/img/favicon-32x32.png"
            width="30"
            height="30"
            alt="InfyOm Logo"
        />
        <img
            class="navbar-brand-minimized"
            src="/img/favicon-16x16.png"
            width="16"
            height="16"
            alt="InfyOm Logo"
        />
    </a>

    {{-- <a class="navbar-brand" href="/">Spotify-Laravel </a> --}}
    <button
        class="navbar-toggler sidebar-toggler d-md-down-none"
        data-toggle="sidebar-lg-show"
        type="button"
    >
        <span class="navbar-toggler-icon"> </span>
    </button>

    <ul class="nav navbar-nav ml-auto">


        @if(!cache()->has('refreshToken'))
            <li class="nav-item dropdown d-md-down-none">
                <a class="btn border rounded px-4 py-1 border-white hover:opacity-75" href="{{ route('spotify.authorize') }}" target="_blank">Authorize</a>
            </li>
        @endif

        <li class="nav-item dropdown d-md-down-none">
            <a
                class="nav-link"
                data-toggle="dropdown"
                href="#"
                role="button"
                aria-haspopup="true"
                aria-expanded="false"
            >
                Profile
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="#" class="dropdown-item btn btn-primary btn btn-default btn-flat"
                   data-toggle="modal" data-id="{{ getLoggedInUserId() }}" data-target="#UserProfileModal">
                    <i class="fa fa-key"></i>UserProfile
                </a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a
                aria-expanded="false"
                aria-haspopup="true"
                class="nav-link"
                data-toggle="dropdown"
                href="#"
                role="button"
            >
                <img
                    alt="admin@bootstrapmaster.com"
                    class="img-avatar"
                    src="{{ asset('/img/avatars/6.jpg') }}"
                />
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a
                    class="dropdown-item"
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault(); localStorage.clear();
                    document.getElementById('logout-form').submit();"
                >
                    {{ __("Logout") }}
                </a>
                <form
                    id="logout-form"
                    action="{{ route('logout') }}"
                    method="POST"
                    style="display: none"
                >
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</header>
