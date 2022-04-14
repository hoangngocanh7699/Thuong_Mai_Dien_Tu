<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/home')}}" class="brand-link">
        <img src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{(isset(Auth::user()->name) ? Auth::user()->name:'')}}</a>

            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @can('category-list')
                    <li class="nav-item">
                        <a href="{{route('categories.index')}}" class="nav-link">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                            <p>
                                Danh mục sản phẩm
                            </p>
                        </a>
                    </li>
                @endcan
                @can('menu-list')
                    <li class="nav-item">
                        <a href="{{route('menus.index')}}" class="nav-link">
                            <i class="fas fa-bars"></i>
                            <p>
                                Menu

                            </p>
                        </a>
                    </li>
                @endcan
                @can('product-list')
                    <li class="nav-item">
                        <a href="{{route('product.index')}}" class="nav-link">
                            <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                            <p>
                                Sản phẩm

                            </p>
                        </a>
                    </li>
                @endcan
                @can('order-list')
                    <li class="nav-item">
                        <a href="{{route('order.index')}}" class="nav-link">
                            <i class="fa fa-credit-card" aria-hidden="true"></i>
                            <p>
                                Đơn hàng
                            </p>
                        </a>
                    </li>
                @endcan
                @can('slider-list')
                    <li class="nav-item">
                        <a href="{{route('slider.index')}}" class="nav-link">
                            <i class="fas fa-sliders-h"></i>
                            <p>
                                Slider

                            </p>
                        </a>
                    </li>
                @endcan
                @can('setting-list')
                    <li class="nav-item">
                        <a href="{{route('setting.index')}}" class="nav-link">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                            <p>
                                Setting

                            </p>
                        </a>
                    </li>
                @endcan
                @can('user-list')
                    <li class="nav-item">
                        <a href="{{route('users.index')}}" class="nav-link">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <p>
                                Người dùng
                            </p>
                        </a>
                    </li>
                @endcan
                @can('role-list')
                    <li class="nav-item">
                        <a href="{{route('roles.index')}}" class="nav-link">
                            <i class='fab fa-critical-role'></i>
                            <p>
                                Vai trò

                            </p>
                        </a>
                    </li>
                @endcan
                @can('permission-list')
                    <li class="nav-item">
                        <a href="{{route('permissions.create')}}" class="nav-link">
                            <i class="fa fa-plane" aria-hidden="true"></i>
                            <p>
                                Tạo dữ liệu permissions

                            </p>
                        </a>
                    </li>
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
