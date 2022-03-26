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
            <a href="{{url('sliders')}}" class="nav-link {{ Request::segment(1) == 'sliders'  ? 'active' : ''}}">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>Slider</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('category')}}" class="nav-link {{ Request::segment(1) == 'category'  ? 'active' : ''}}">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>Category</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('brand')}}" class="nav-link {{ Request::segment(1) == 'brand'  ? 'active' : ''}}">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>Brand</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('unit')}}" class="nav-link {{ Request::segment(1) == 'unit'  ? 'active' : ''}}">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>Unit</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('product-list')}}" class="nav-link {{ Request::segment(1) == 'product-list'  ? 'active' : ''}}">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>Product</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('article')}}" class="nav-link {{ Request::segment(1) == 'article'  ? 'active' : ''}}">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>Article</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('user-list')}}" class="nav-link {{ Request::segment(1) == 'user-list'  ? 'active' : ''}}">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>User List</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('order-list')}}" class="nav-link {{ Request::segment(1) == 'order-list'  ? 'active' : ''}}">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>Order List</p>
            </a>
        </li>
    </ul>
</nav>
