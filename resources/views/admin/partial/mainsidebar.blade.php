<aside class="main-sidebar sidebar-light-teal elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('dashboard')}}" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Green</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{'profile'}}" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
    @if(auth()->user()->role == 1)
        @include('admin.partial.menu')
    @elseif(auth()->user()->role == 2)
        @include('admin.partial.v-menu')
    @else

    @endif
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

