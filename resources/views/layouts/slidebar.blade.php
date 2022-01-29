<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="https://scontent.fpnh2-1.fna.fbcdn.net/v/t39.30808-6/270047228_3123214151337902_5498539842595182643_n.jpg?_nc_cat=110&ccb=1-5&_nc_sid=09cbfe&_nc_eui2=AeGkEJr7YWxk4O-VDQAD-yj73rRyta0giyHetHK1rSCLIeEp5bUfsgaF0B5c8R_d497Pftp1NxztmokGqGs4SrrB&_nc_ohc=D-phJxtKa6MAX_kU89u&_nc_oc=AQklLQgTG5A4YSAjQj8X24awoDQXdIOFtWmvnVRr-ccyYc_Da3uXPpOh_sNEjzZzs74&_nc_zt=23&_nc_ht=scontent.fpnh2-1.fna&oh=00_AT_bmmVWWr259McNK6h7ncdVsvgfiDuI889G5GAVSSDkvw&oe=61F6CB41" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">មោង ផានិត</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item ">
            <a href="{{url('/')}}" class="nav-link" id="dashboard_menu">
                <i class="fas fa-home"></i>
              <p>
               ផ្ទាំងគ្រប់គ្រង
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{route('category.index')}}" class="nav-link" id="category_menu">
                <i class="fas fa-cart-arrow-down"></i>
              <p>
               ប្រភេទទំនិញ
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{route('unit.index')}}" class="nav-link" id="unit_menu">
                <i class="fas fa-cart-plus"></i>
              <p>
               ខ្នាតទំនិញ
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{route('product.index')}}" class="nav-link" id="product_menu">
                <i class="fab fa-product-hunt"></i>
              <p>
              ទំនិញ
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{route('stock_in.index')}}" class="nav-link" id="stock_in_menu">
                <i class="fas fa-warehouse"></i>
              <p>
               ស្តុកចូល
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{route('stock_out.index')}}" class="nav-link" id="stock_out_menu">
                <i class="fas fa-warehouse"></i>
              <p>
               ស្តុកចេញ
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{route('scrap.index')}}" class="nav-link" id="scrap_menu">
                <i class="fas fa-file"></i>
              <p>
               ខូច និង ហួសកំណត់
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{route('invoice.index')}}" class="nav-link" id="invoice_menu">
                <i class="fas fa-file"></i>
              <p>
               វិក្កយបត្រ
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{route('report.index')}}" class="nav-link" id="report_menu">
                <i class="fas fa-chart-line"></i>
              <p>
               របាយការណ៍
              </p>
            </a>
          </li>

          <li class="nav-item ">
            <a href="{{route('role.index')}}" class="nav-link" id="role_menu">
             <i class="fa fa-user-lock"></i>
              <p>
                តូនាទី
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{route('user.index')}}" class="nav-link" id="user_menu">
             <i class="fa fa-users"></i>
              <p>
                អ្នកប្រើប្រាស់
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{url('/logout')}}" class="nav-link" id="user_menu">
                <i class="fas fa-sign-out-alt"></i>
              <p>
                ចាកចេញ
              </p>
            </a>
          </li>


      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
