<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <a class="navbar-brand" href="/">Promobit</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="conteudoNavbar">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'Admin.Products' ? 'active' : '' }}" href="{{ route('Admin.Products') }}">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'Admin.Tags' ? 'active' : '' }}" href="{{ route('Admin.Tags') }}">Tags</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'Admin.Users' ? 'active' : '' }}" href="{{ route('Admin.Users') }}">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'Admin.Roles' ? 'active' : '' }}" href="{{ route('Admin.Roles') }}">Roles</a>
            </li>
        </ul>
    </div>
</nav>
