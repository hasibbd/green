@include('frontend.partial.top-head')
<header class="header-part">
    <div class="container">
        <div class="header-content">
            <div class="header-media-group">
                <button class="header-user">
                    @if(Auth::user())
                        <img src="/storage/user/{{Auth::user()->photo}}" alt="user"></button>
                    @else
                    <img src="{{asset('frontend/images/user.png')}}" alt="user">
                    @endif
                </button>
                <a href="{{url('/')}}"><img src="{{asset('frontend/images/logo.png')}}" alt="logo"></a>
                <button class="header-src"><i class="fas fa-search"></i></button>
            </div>
                <a href="{{url('/')}}" class="header-logo">
                    <img src="{{asset('frontend/images/logo.png')}}" alt="logo">
                </a>
            @if(!auth()->user())
                <a href="{{url('login')}}" class="header-widget" title="My Account">
                    <span>Login</span>
                </a>
            @else
            <a href="{{url('my-profile')}}" class="header-widget" title="My Account">
                <img src="/storage/user/{{Auth::user()->photo}}" alt="user">
                <span>My Profile</span>
            </a>
            @endif
            <form class="header-form">
                <input type="text" placeholder="Search anything...">
                <button><i class="fas fa-search"></i></button>
            </form>
            <div class="header-widget-group">
              {{--  <a href="#" class="header-widget" title="Compare List"><i
                        class="fas fa-random"></i><sup>0</sup></a>
                <a href="#" class="header-widget" title="Wishlist"><i class="fas fa-heart"></i><sup>0</sup></a>--}}
                @if(auth()->user())
                <a href="{{url('logout')}}" class="header-widget" title="Logout">Logout</a>
                @endif
                <button class="header-widget header-cart" title="Cartlist"><i
                        class="fas fa-shopping-basket"></i><sup class="t_cart_item">0</sup><span>total price<small id="t_cart_price">00.00</small></span>
                </button>
            </div>
        </div>
    </div>
</header>
