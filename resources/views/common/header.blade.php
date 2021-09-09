<header class="app-header navbar">
    <button
        class="navbar-toggler sidebar-toggler d-lg-none mr-auto"
        data-toggle="sidebar-show"
        type="button"
    >
        <span class="navbar-toggler-icon"> </span>
    </button>
    <a class="navbar-brand" href="/">CoreUI-Laravel </a>
    <button
        class="navbar-toggler sidebar-toggler d-md-down-none"
        data-toggle="sidebar-lg-show"
        type="button"
    >
        <span class="navbar-toggler-icon"> </span>
    </button>
    <ul class="nav navbar-nav ml-auto">
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
                    src="{{ asset('img/avatars/6.jpg') }}"
                />
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a
                    class="dropdown-item"
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault();
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
