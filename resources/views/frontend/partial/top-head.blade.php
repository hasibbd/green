<div class="header-top">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="header-top-welcome"><p>Welcome to ShoppingBook!</p></div>
            </div>
       {{--     <div class="col-md-5 col-lg-3">
                <div class="header-top-select">
                    <div class="header-select"><i class="icofont-world"></i><select class="select">
                            <option value="english" selected="">english</option>
                            <option value="bangali">bangali</option>
                            <option value="arabic">arabic</option>
                        </select></div>
                    <div class="header-select"><i class="icofont-money"></i><select class="select">
                            <option value="english" selected="">doller</option>
                            <option value="bangali">pound</option>
                            <option value="arabic">taka</option>
                        </select></div>
                </div>
            </div>--}}
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
