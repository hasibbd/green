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
        <li class="nav-item
        {{ Request::segment(1) == 'product-list'  ? 'menu-open' : ''}}
        {{ Request::segment(1) == 'unit'  ? 'menu-open' : ''}}
        {{ Request::segment(1) == 'brand'  ? 'menu-open' : ''}}
        {{ Request::segment(1) == 'category'  ? 'menu-open' : ''}}
            ">
            <a href="#" class="nav-link
           {{ Request::segment(1) == 'product-list'  ? 'active' : ''}}
            {{ Request::segment(1) == 'unit'  ? 'active' : ''}}
            {{ Request::segment(1) == 'brand'  ? 'active' : ''}}
            {{ Request::segment(1) == 'category'  ? 'active' : ''}}
                ">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>
                    Products Control
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview small">
                <li class="nav-item">
                    <a href="{{url('category')}}" class="nav-link {{ Request::segment(1) == 'category'  ? 'active' : ''}}">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('brand')}}" class="nav-link {{ Request::segment(1) == 'brand'  ? 'active' : ''}}">
                        <i class="nav-icon fas fa-code-branch"></i>
                        <p>Brand</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('unit')}}" class="nav-link {{ Request::segment(1) == 'unit'  ? 'active' : ''}}">
                        <i class="nav-icon fas fa-balance-scale-left"></i>
                        <p>Unit</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('product-list')}}" class="nav-link {{ Request::segment(1) == 'product-list'  ? 'active' : ''}}">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>Product</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item
        {{ Request::segment(1) == 'sliders'  ? 'menu-open' : ''}}
        {{ Request::segment(1) == 'article'  ? 'menu-open' : ''}}
            ">
            <a href="#" class="nav-link
            {{ Request::segment(1) == 'sliders'  ? 'active' : ''}}
            {{ Request::segment(1) == 'article'  ? 'active' : ''}}
                ">
                <i class="nav-icon fas fa-laptop-house"></i>
                <p>
                    Home Page Control
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview small">
                <li class="nav-item">
                    <a href="{{url('sliders')}}" class="nav-link {{ Request::segment(1) == 'sliders'  ? 'active' : ''}}">
                        <i class="nav-icon fas fa-sliders-h"></i>
                        <p>Slider</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('article')}}" class="nav-link {{ Request::segment(1) == 'article'  ? 'active' : ''}}">
                        <i class="nav-icon far fa-newspaper"></i>
                        <p>Article</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item
        {{ Request::segment(1) == 'flying-user-list'  ? 'menu-open' : ''}}
        {{ Request::segment(1) == 'admin-user-list'  ? 'menu-open' : ''}}
        {{ Request::segment(1) == 'user-list'  ? 'menu-open' : ''}}
        {{ Request::segment(1) == 'store-user-list'  ? 'menu-open' : ''}}
            ">
            <a href="#" class="nav-link
            {{ Request::segment(1) == 'flying-user-list'  ? 'active' : ''}}
            {{ Request::segment(1) == 'admin-user-list'  ? 'active' : ''}}
            {{ Request::segment(1) == 'user-list'  ? 'active' : ''}}
            {{ Request::segment(1) == 'store-user-list'  ? 'active' : ''}}
                ">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    User Control
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview small">
                <li class="nav-item">
                    <a href="{{url('admin-user-list')}}" class="nav-link {{ Request::segment(1) == 'admin-user-list'  ? 'active' : ''}}">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>Admin List</p>
                    </a>
                    <a href="{{url('flying-user-list')}}" class="nav-link {{ Request::segment(1) == 'flying-user-list'  ? 'active' : ''}}">
                        <i class="nav-icon fas fa-user-clock"></i>
                        <p>Flying User List</p>
                    </a>
                    <a href="{{url('user-list')}}" class="nav-link {{ Request::segment(1) == 'user-list'  ? 'active' : ''}}">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>User List</p>
                    </a>
                    <a href="{{url('store-user-list')}}" class="nav-link {{ Request::segment(1) == 'store-user-list'  ? 'active' : ''}}">
                        <i class="nav-icon fas fa-user-tag"></i>
                        <p>Store List</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item
        {{ Request::segment(1) == 'user-application-list'  ? 'menu-open' : ''}}
        {{ Request::segment(1) == 'store-application-list'  ? 'menu-open' : ''}}
            ">
            <a href="#" class="nav-link
            {{ Request::segment(1) == 'user-application-list'  ? 'active' : ''}}
            {{ Request::segment(1) == 'store-application-list'  ? 'active' : ''}}
                ">
                <i class="nav-icon fas fa-tablet-alt"></i>
                <p>
                    Application Control
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview small">
                <li class="nav-item">
                    <a href="{{url('user-application-list')}}" class="nav-link {{ Request::segment(1) == 'user-application-list'  ? 'active' : ''}}">
                        <i class="nav-icon far fa-address-card"></i>
                        <p>User Application</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('store-application-list')}}" class="nav-link {{ Request::segment(1) == 'store-application-list'  ? 'active' : ''}}">
                        <i class="nav-icon fas fa-store-alt"></i>
                        <p>Store Manager Application</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item
        {{ Request::segment(1) == 'order-list'  ? 'menu-open' : ''}}
            ">
            <a href="#" class="nav-link
            {{ Request::segment(1) == 'order-list'  ? 'active' : ''}}
                ">
                <i class="nav-icon fas fa-luggage-cart"></i>
                <p>
                    Order Control
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview small">
                <li class="nav-item">
                    <a href="{{url('order-list')}}" class="nav-link {{ Request::segment(1) == 'order-list'  ? 'active' : ''}}">
                        <i class="nav-icon fas fa-baby-carriage"></i>
                        <p>Order List</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item
        {{ Request::segment(1) == 'setting'  ? 'menu-open' : ''}}
        {{ Request::segment(1) == 'generation-setting'  ? 'menu-open' : ''}}
            ">
            <a href="#" class="nav-link
            {{ Request::segment(1) == 'setting'  ? 'active' : ''}}
            {{ Request::segment(1) == 'generation-setting'  ? 'active' : ''}}
                ">
                <i class="nav-icon fas fa-tools"></i>
                <p>
                   Setting
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview small">
                <li class="nav-item">
                    <a href="{{url('setting')}}" class="nav-link {{ Request::segment(1) == 'setting'  ? 'active' : ''}}">
                        <i class="nav-icon fab fa-buffer"></i>
                        <p>Point Setting</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('generation-setting')}}" class="nav-link {{ Request::segment(1) == 'generation-setting'  ? 'active' : ''}}">
                        <i class="nav-icon fab fa-buffer"></i>
                        <p>Generation Setting</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item
        {{ Request::segment(1) == 'user-account'  ? 'menu-open' : ''}}
        {{ Request::segment(1) == 'store-manager-account'  ? 'menu-open' : ''}}
        {{ Request::segment(1) == 'point-account'  ? 'menu-open' : ''}}
        {{ Request::segment(1) == 'company-account'  ? 'menu-open' : ''}}
        {{ Request::segment(1) == 'user-reserve-account'  ? 'menu-open' : ''}}
            ">
            <a href="#" class="nav-link
            {{ Request::segment(1) == 'user-account'  ? 'active' : ''}}
            {{ Request::segment(1) == 'store-manager-account'  ? 'active' : ''}}
            {{ Request::segment(1) == 'point-account'  ? 'active' : ''}}
            {{ Request::segment(1) == 'company-account'  ? 'active' : ''}}
            {{ Request::segment(1) == 'user-reserve-account'  ? 'active' : ''}}
                ">
                <i class="fas fa-boxes nav-icon"></i>
                <p>
                    Account Control
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview small">
                <li class="nav-item">
                    <a href="{{url('user-account')}}" class="nav-link {{ Request::segment(1) == 'user-account'  ? 'active' : ''}}">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>User Account</p>
                    </a>
                </li>  <li class="nav-item">
                    <a href="{{url('user-reserve-account')}}" class="nav-link {{ Request::segment(1) == 'user-reserve-account'  ? 'active' : ''}}">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>User Reserve Account</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('store-manager-account')}}" class="nav-link {{ Request::segment(1) == 'store-manager-account'  ? 'active' : ''}}">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>Store Manager Account</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('company-account')}}" class="nav-link {{ Request::segment(1) == 'company-account'  ? 'active' : ''}}">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>Company Account</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('point-account')}}" class="nav-link {{ Request::segment(1) == 'point-account'  ? 'active' : ''}}">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>Point Account</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
