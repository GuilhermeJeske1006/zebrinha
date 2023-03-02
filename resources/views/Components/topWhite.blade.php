<header class="header-v4">
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
                <div class="left-top-bar">
                </div>

                <div class="right-top-bar flex-w h-full">

                    @if(Auth::guest())
                    <a href="{{route('login')}}" class="flex-c-m trans-04 p-lr-25">
                        Login
                    </a>

                    <a href="{{route('register')}}" class="flex-c-m trans-04 p-lr-25">
                        Registre-se
                    </a>
                    @endif
                    @if(Auth::check())
                            <a href="" class="flex-c-m trans-04 p-lr-25">
                                Bem vindo de volta

                            </a>
                            <div class="dropdown">
                                <a class="dropdown-toggle flex-c-m trans-04 p-lr-25 " type="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #b2b2b2">
                                    {{auth()->user()->name}}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark" style="    z-index: 9999;">
                                    <li><a class="dropdown-item" href="{{ route('profile.show') }}">Minha conta</a></li>
                                    <li><a class="dropdown-item" href="{{ route('compra_historico') }}">Minhas compras</a></li>
                                    <li><form method="POST" action="{{ route('logout') }}" class="flex-c-m trans-04 p-lr-25 right-top-bar a" style="justify-content: flex-start;">
                                            @csrf
                                            <button type="submit" class="btn-logout">Logout</button>

                                        </form></li>
                                </ul>
                            </div>


                        @endif
                </div>
            </div>
        </div>

        <div class="wrap-menu-desktop how-shadow1">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="{{route('index')}}" class="logo">
                    <img src="{{asset('images/icons/logo.png')}}" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li>
                            <a class="active" href="{{route('index')}}">Home</a>
                        </li>
                        <li>
                            <a href="{{route('produtos')}}">Produtos</a>
                        </li>
                        <li>
                            <a href="{{route('contato')}}">Contato</a>
                        </li>
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">


                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="{{count($carrinho)}}">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="{{route('index')}}"><img src="{{asset('images/icons/logo.png')}}" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">


            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="{{count($carrinho)}}">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile">
            <li>
                <div class="left-top-bar">
                </div>
            </li>

            <li>
                <div class="right-top-bar flex-w h-full">


                    <a href="{{route('login')}}" class="flex-c-m p-lr-10 trans-04">
                        Login
                    </a>

                    <a href="{{route('register')}}" class="flex-c-m p-lr-10 trans-04">
                        Registrar-se
                    </a>
                </div>
            </li>
        </ul>

        <ul class="main-menu-m">
            <li>
                <a href="{{route('index')}}">Home</a>
            </li>

            <li>
                <a href="{{route('produtos')}}">Produtos</a>
            </li>
            <li>
                <a href="{{route('contato')}}">Contato</a>
            </li>
        </ul>
    </div>

</header>

@component('home.Cart', ['carrinho' => $carrinho])@endcomponent

<style>
    .btn-logout {
        font-family: Poppins-Regular;
        font-size: 12px;
        line-height: 1.8;
        height: 100%;
        color: #b2b2b2;
    }
</style>
