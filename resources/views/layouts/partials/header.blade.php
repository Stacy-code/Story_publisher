<nav class="navbar navbar-expand-lg navbar-light bg-warning text-dark">
    <a class="navbar-brand" href="/">Бренд</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">Головна</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/stories') }}"><strong>Історії</strong></a>
            </li>
        </ul>
    </div>
</nav>
