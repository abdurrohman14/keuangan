@auth
    @php
        $user = auth()->user();
    @endphp
@endauth

<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('admin.dashboard') }}" class="logo">
                <img src="{{ asset('assets/img/mudapedia/logo.mudapedia.png ') }}" alt="navbar brand" class="navbar-brand"
                    height="60" />
                <div class="ml-2 text-white d-flex flex-column">
                    <span style="font-size: 12px; line-height: 1;">Aplikasi Manajemen</span>
                    <span style="font-size: 12px; line-height: 1;">Keuangan</span>
                </div>
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                {{-- Role Admin --}}
                @if ($user->role === App\Models\User::ROLE_ADMIN)
                    <li class="nav-item active">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.akun') }}">
                            <i class="fas fa-layer-group"></i>
                            <p>Kode Akun</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.transaksi') }}">
                            <i class="fas fa-th-list"></i>
                            <p>Transaksi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarLayouts">
                            <i class="fas fa-pen-square"></i>
                            <p>Jurnal</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarLayouts">
                            <i class="fas fa-book"></i>
                            <p>Buku Besar</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#charts">
                            <i class="far fa-chart-bar"></i>
                            <p>Laporan Keuangan</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="charts">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="charts/charts.html">
                                        <span class="sub-item">Laporan Laba Rugi</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="charts/sparkline.html">
                                        <span class="sub-item">Laporan Neraca</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="charts/sparkline.html">
                                        <span class="sub-item">Laporan Arus Kas</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- Role Staf --}}
                @elseif ($user->role === App\Models\User::ROLE_STAF)
                    <li class="nav-item active">
                        <a href="{{ route('staf.dashboard') }}">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('index.kodeAkun') }}">
                            <i class="fas fa-layer-group"></i>
                            <p>Kode Akun</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('staf.transaksi') }}">
                            <i class="fas fa-th-list"></i>
                            <p>Transaksi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a  href="{{ route('staf.jurnal.umum') }}">
                            <i class="fas fa-pen-square"></i>
                            <p>Jurnal</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#tables">
                            <i class="fas fa-solid fa-book"></i>
                            <p>Buku Besar</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#charts">
                            <i class="far fa-chart-bar"></i>
                            <p>Laporan Keuangan</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="charts">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="charts/charts.html">
                                        <span class="sub-item">Laporan Laba Rugi</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="charts/sparkline.html">
                                        <span class="sub-item">Laporan Neraca</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="charts/sparkline.html">
                                        <span class="sub-item">Laporan Arus Kas</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- Role Manajer --}}
                @elseif ($user->role === App\Models\User::ROLE_MANAJER)
                    <li class="nav-item active">
                        <a href="{{ route('manajer.dashboard') }}">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('manajer.akun') }}">
                            <i class="fas fa-layer-group"></i>
                            <p>Kode Akun</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('manajer.transaksi') }}">
                            <i class="fas fa-th-list"></i>
                            <p>Transaksi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#forms">
                            <i class="fas fa-pen-square"></i>
                            <p>Jurnal</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#tables">
                            <i class="fas fa-table"></i>
                            <p>Buku Besar</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#charts">
                            <i class="far fa-chart-bar"></i>
                            <p>Laporan Keuangan</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="charts">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="charts/charts.html">
                                        <span class="sub-item">Laporan Laba Rugi</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="charts/sparkline.html">
                                        <span class="sub-item">Laporan Neraca</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="charts/sparkline.html">
                                        <span class="sub-item">Laporan Arus Kas</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
