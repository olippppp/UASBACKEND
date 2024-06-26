 <!-- Navbar start -->
 <div class="container-fluid fixed-top">
     <div class="container topbar bg-primary d-none d-lg-block">
         <div class="d-flex justify-content-between">
             <div class="top-info ps-2">
                 <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#"
                         class="text-white">Jl. Lokomotif No. 108 B
                     </a></small>
                 <small class="me-3"><i class="fas fa-phone-alt me-2 text-secondary"></i><a href="#"
                         class="text-white">0821-7258-8200</a></small>
             </div>
         </div>
     </div>
     <div class="container px-0">
         <nav class="navbar navbar-light bg-white navbar-expand-xl">
             <a href="index.html" class="navbar-brand">
                 <h1 class="text-primary display-6" style="font-size: 25px; text-align: center">Kedai Kopi <br />Delima
                 </h1>
             </a>
             <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                 data-bs-target="#navbarCollapse">
                 <span class="fa fa-bars text-primary"></span>
             </button>
             @if (request()->is('admin*'))
                 <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                     <div class="navbar-nav mx-auto">
                         <a href="{{ route('admin') }}" class="nav-item nav-link {{ request()->is('admin') ? 'active' : '' }}">Beranda</a>
                         <a href="{{ route('admin.kategori') }}" class="nav-item nav-link {{ request()->is('admin/kategori*') ? 'active' : '' }}">Kategori</a>
                         <a href="{{ route('admin.menu') }}" class="nav-item nav-link {{ request()->is('admin/menu*') ? 'active' : '' }}">Menu</a>
                         <a href="{{ route('admin') }}" class="nav-item nav-link">Pemesanan</a>
                         <a href="{{ route('admin') }}" class="nav-item nav-link">Admin</a>
                         <a href="{{ route('admin') }}" class="nav-item nav-link">Customer</a>

                         <a href="{{ route('beranda') }}" class="nav-item nav-link">Logout</a>
                     </div>
                     <div class="d-flex m-3 me-0">
                         
                     </div>
                 </div>
             @else
                 <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                     <div class="navbar-nav mx-auto">
                         <a href="{{ route('beranda') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Beranda</a>
                         <a href="{{ route('menu_kategori') }}" class="nav-item nav-link {{ request()->is('menu*') ? 'active' : '' }}">Menu</a>
                         <a href="{{ route('beranda') }}" class="nav-item nav-link">Riwayat Pemesanan</a>
                         <a href="{{ route('beranda') }}" class="nav-item nav-link">Kontak Kami</a>

                         <a href="{{ route('beranda') }}" class="nav-item nav-link">Kontak</a>
                         <a href="{{ route('beranda') }}" class="nav-item nav-link">Login</a>
                         <a href="{{ route('admin') }}" class="nav-item nav-link">Admin</a>
                     </div>
                     <div class="d-flex m-3 me-0">
                         <a href="#" class="position-relative me-4 my-auto">
                             <i class="fa fa-shopping-bag fa-2x"></i>
                             <span
                                 class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                                 style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span>
                         </a>
                         <a href="#" class="my-auto">
                             <i class="fas fa-user fa-2x"></i>
                         </a>
                     </div>
                 </div>
             @endif
         </nav>
     </div>
 </div>
 <!-- Navbar End -->
