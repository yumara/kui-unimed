<!-- leftbar-tab-menu -->
<div class="startbar d-print-none">
    <!--start brand-->
    <div class="brand">
        <a href="index.html" class="logo">
            <span>
                <img src="{{ asset('images/unimed.png') }}" alt="logo-small" class="logo-sm">
            </span>
            <span class="">
                <img src="{{ asset('images/kui-light-med.png') }}" alt="logo-large" class="logo-lg logo-light">
                <img src="{{ asset('images/kui-dark-med.png') }}" alt="logo-large" class="logo-lg logo-dark">
            </span>
        </a>
    </div>
    <!--end brand-->
    <!--start startbar-menu-->
    <div class="startbar-menu" >
        <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
            <div class="d-flex align-items-start flex-column w-100">
                <!-- Navigation -->
                <ul class="navbar-nav mb-auto w-100">
                    <li class="menu-label pt-0 mt-0">
                        <!-- <small class="label-border">
                            <div class="border_left hidden-xs"></div>
                            <div class="border_right"></div>
                        </small> -->
                        <span>Menu Utama</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.index')}}" role="button"
                            aria-expanded="false" aria-controls="sidebarDashboards">
                            <i class="iconoir-home-simple menu-icon"></i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li class="menu-label mt-2">
                        <small class="label-border">
                            <div class="border_left hidden-xs"></div>
                            <div class="border_right"></div>
                        </small>
                        <span>Pengajuan</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarElements" role="button"
                            aria-expanded="false" aria-controls="sidebarElements">
                            <i class="iconoir-book menu-icon"></i>
                            <span>Izin Belajar Mahasiswa Asing</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarElements" role="button"
                            aria-expanded="false" aria-controls="sidebarElements">
                            <i class="iconoir-journal-page menu-icon"></i>
                            <span>Layanan E-Visa</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarAdvancedUI" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarAdvancedUI">
                            <i class="iconoir-graduation-cap menu-icon"></i>
                            <span>PDLN Setneg</span>
                        </a>
                        <div class="collapse " id="sidebarAdvancedUI">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="advanced-animation.html">Tugas Harian</a>
                                </li><!--end nav-item-->
                                <li class="nav-item">
                                    <a class="nav-link" href="advanced-clipboard.html">Surat Keterangan Pembayaran</a>
                                </li><!--end nav-item-->
                            </ul><!--end nav-->
                        </div><!--end startbarAdvancedUI-->
                    </li><!--end nav-item-->

                </ul><!--end navbar-nav--->
            </div>
        </div><!--end startbar-collapse-->
    </div><!--end startbar-menu-->
</div><!--end startbar-->
<div class="startbar-overlay d-print-none"></div>
<!-- end leftbar-tab-menu-->
