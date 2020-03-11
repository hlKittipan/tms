<nav class="navbar navbar-expand-lg navbar-light bg-light d-flex  fixed-top">
    <a class="navbar-brand" href="/">Logo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav m-auto p-1 d-flex justify-content-between align-items-center">
            <li class="nav-item m-auto px-2">
                <a class="nav-link" href="{{url('/')}}">Home</a>
            </li>
            <li class="nav-item m-auto px-2">
                <a class="nav-link" href="{{route('search/booking')}}">View Booking</a>
            </li>
            <li class="nav-item dropdown m-auto px-2">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Tour
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('search',['country'=>'1'])}}">Phuket</a>
                    <a class="dropdown-item" href="{{route('search',['country'=>'2'])}}">Pangnga</a>
                    <a class="dropdown-item" href="{{route('search',['country'=>'3'])}}">Krabi</a>
                    {{--<div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>--}}
                </div>
            </li>
            <li class="nav-item m-auto px-2">
                <a class="nav-link" href="#">About us</a>
            </li>
            <li class="nav-item m-auto px-2">
                <a class="nav-link" href="#">Contact us</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="{{route('search')}}">
            <input class="form-control mr-sm-2" type="text" placeholder="Quick Search" aria-label="Search" name="search">
            <button class="btn search-outline-blue my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
</nav>
