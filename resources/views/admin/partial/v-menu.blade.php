<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{url('vendor-dashboard')}}" class="nav-link {{ Request::segment(1) == 'vendor-dashboard'  ? 'active' : ''}}">
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
                <p>Product List</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{url('seller-order-list')}}"
               class="nav-link {{ request()->is() == 'seller-order-list'  ? 'active' : ''}}">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>Order List</p>
            </a>
        </li>

    </ul>
</nav>
