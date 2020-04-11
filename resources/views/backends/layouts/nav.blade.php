<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('letmepass') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item hidden">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown {{ routeIsActive(['backend.booking.index','backend.booking.create']) }}">
                        <a id="booking" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fas fa-book"></i> Report <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="booking">
                            <a class="dropdown-item" href="{{route('backend.report',['reportType'=>'sales'])}}"> Sales </a>
                            <a class="dropdown-item" href="{{route('backend.report',['reportType'=>'products'])}}"> Product </a>
                            {{--<a class="dropdown-item" href="#"> View </a>
                            <a class="dropdown-item" href="#"> Visit country </a>--}}
                        </div>

                    </li>
                    <li class="nav-item dropdown {{ routeIsActive(['backend.booking.index','backend.booking.create']) }}">
                        <a id="booking" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fas fa-cart-plus"></i> {{ __('book.booking') }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="booking">
                            <a class="dropdown-item" href="{{ route('backend.booking.create') }}">
                                <i class="fas fa-cart-plus"></i> {{ __('book.add_booking') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('backend.booking.index') }}">
                                <i class="fas fa-list-ul"></i> {{ __('book.booking') }}
                            </a>
                        </div>

                    </li>
                    <li class="nav-item dropdown {{ routeIsActive(['backend.product.index','backend.product.after','backend.product_type.index','backend.transport.index']) }}">
                        <a id="product" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fas fa-suitcase"></i> {{ __('product.product') }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="product">
                            <a class="dropdown-item" href="{{ route('backend.product_type.index') }}">
                                <i class="fas fa-bookmark"></i> {{ __('product.product_type') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('backend.product.index') }}">
                                <i class="fas fa-suitcase"></i> {{ __('product.product') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('backend.transport.index') }}">
                                <i class="fas fa-car"></i> {{ __('product.transport') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('backend.province.index') }}">
                                <i class="fas fa-globe-asia"></i> {{ __('product.province') }}
                            </a>
                        </div>

                    </li>
                    <li class="nav-item {{ routeIsActive(['backend.user.index','backend.setup.index']) }}">
                        <a class="nav-link" href="{{ route('backend.user.index') }}"> <i class="fas fa-users"></i> {{ __('staff.user_management') }}</a>
                    </li>
                    <li class="nav-item dropdown {{ routeIsActive(['backend.setup.index']) }}">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fas fa-user"></i> {{ Auth::user()->username }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('backend.setup.index') }}">
                                <i class="fas fa-cogs"></i> {{ __('setup.config') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
