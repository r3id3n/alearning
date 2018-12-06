<header>
    <nav class="navbar navbar-expand-md navbar.light navbar-laravel">
        <div class="container">
            {{-- Creacion de enlaces --}}
            <a class="navbar-brand" href=" {{url('/')}} ">
                {{-- traeremos valores de APP esto nos sirve para mostrar el nombre de nuestra aplicacion--}}
                {{ config ('app.name')}}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mr-auto">

                </ul>
                <ul class="navbar-nav ml-auto">
                    @include('partials.navigations.' . \App\User::navigation())
                    <li class="nav-item dropdown">
                        <a 
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="navbarDropdownMenuLink"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            {{__("Selecciona un idioma")}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a 
                                class="dropdown-item"
                                href="{{ route('set_language', ['es']) }}"
                            >
                                {{__("Español")}}
                            </a>
                            <a 
                                class="dropdown-item"
                                href="{{ route('set_language', ['en']) }} "
                            >
                                {{__("Ingles")}}
                            </a>
                        </div>
                    </li>
                </ul> 
            </div>
        </div>
    </nav>
</header>