<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{url('dashboard')}}" class="nav-link {{ Request::segment(1) == 'dashboard'  ? 'active' : ''}}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{url('vendor-product-list')}}"
               class="nav-link {{ Request::segment(1) == 'vendor-product-list'  ? 'active' : ''}}">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>All Product List</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{url('my-product-list')}}"
               class="nav-link {{ Request::segment(1) == 'my-product-list'  ? 'active' : ''}}">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>My Product List</p>
            </a>
        </li>

    </ul>
</nav>
