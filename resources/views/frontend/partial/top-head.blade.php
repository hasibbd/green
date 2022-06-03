<div class="header-top">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="header-top-welcome"><p>Welcome to ShoppingBook!</p></div>
            </div>
            <div class="col-md-4">
                <ul class="header-top-list">
                    @if(!Auth::user())
                    <li><a href="{{url('registration')}}">Registration</a></li>
                    @else
                    <li><a href="{{url('logout')}}">Logout</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
