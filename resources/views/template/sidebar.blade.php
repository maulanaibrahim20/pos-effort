<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            @if (Auth::user()->role_id == 1)
                <a class="header-brand1" href="{{ url('/admin/dashboard') }}">
                @elseif (Auth::user()->role_id == 2)
                    <a class="header-brand1" href="{{ url('/member/dashboard') }}">
            @endif
            <img src="{{ url('/assets') }}/images/brand/logo.png" class="header-brand-img main-logo" alt="Sparic logo">
            <img src="{{ url('/assets') }}/images/brand/logo-light.png" class="header-brand-img darklogo"
                alt="Sparic logo">
            <img src="{{ url('/assets') }}/images/brand/icon.png" class="header-brand-img icon-logo" alt="Sparic logo">
            <img src="{{ url('/assets') }}/images/brand/icon2.png" class="header-brand-img icon-logo2"
                alt="Sparic logo">
            </a>
        </div>
        <!-- logo-->
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div>
            <ul class="side-menu">
                <li class="sub-category">
                    <h3>Main</h3>
                </li>
                @auth
                    @if (Auth::user()->role_id == 1)
                        <li>
                            <a class="side-menu__item {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}"
                                href="{{ url('/admin/dashboard') }}"><i class="side-menu__icon fa fa-home"></i><span
                                    class="side-menu__label">Dashboard</span></a>
                        </li>
                    @elseif(Auth::user()->role_id == 2)
                        <li>
                            <a class="side-menu__item {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}"
                                href="{{ url('/member/dashboard') }}"><i class="side-menu__icon fa fa-home"></i><span
                                    class="side-menu__label">Dashboard</span></a>
                        </li>
                    @endif
                @endauth
                @can('admin')
                    <li class="sub-category">
                        <h3>Master Data</h3>
                    </li>
                    <li>
                        <a class="side-menu__item {{ Request::segment(3) == 'kategori' ? 'active' : '' }}"
                            href="{{ url('/admin/master/kategori') }}"><i class="side-menu__icon fe fe-box"></i><span
                                class="side-menu__label">Kategori</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}"
                            href="{{ url('/admin/master/produk') }}"><i class="side-menu__icon fe fe-package"></i><span
                                class="side-menu__label">Produk</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}"
                            href="{{ url('/admin/dashboard') }}"><i class="side-menu__icon fe fe-credit-card"></i><span
                                class="side-menu__label">Member</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}"
                            href="{{ url('/admin/dashboard') }}"><i class="side-menu__icon fe fe-truck"></i><span
                                class="side-menu__label">Supplier</span></a>
                    </li>
                    <li class="sub-category">
                        <h3>Transaksi</h3>
                    </li>
                    <li>
                        <a class="side-menu__item {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}"
                            href="{{ url('/admin/dashboard') }}"><i class="side-menu__icon fe fe-dollar-sign"></i><span
                                class="side-menu__label">Pengeluaran</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}"
                            href="{{ url('/admin/dashboard') }}"><i
                                class="side-menu__icon fe fe-arrow-down-circle"></i><span
                                class="side-menu__label">Pembelian</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}"
                            href="{{ url('/admin/dashboard') }}"><i class="side-menu__icon fe fe-arrow-up-circle"></i><span
                                class="side-menu__label">Penjualan</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}"
                            href="{{ url('/admin/dashboard') }}"><i class="side-menu__icon fe fe-shopping-bag"></i><span
                                class="side-menu__label">Transaksi Lama</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}"
                            href="{{ url('/admin/dashboard') }}"><i class="side-menu__icon fe fe-shopping-cart"></i><span
                                class="side-menu__label">Transaksi Baru</span></a>
                    </li>
                    <li class="sub-category">
                        <h3>Report</h3>
                    </li>
                    <li>
                        <a class="side-menu__item {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}"
                            href="{{ url('/admin/dashboard') }}"><i class="side-menu__icon fe fe-file-text"></i><span
                                class="side-menu__label">Laporan</span></a>
                    </li>
                    <li class="sub-category">
                        <h3>Pengaturan</h3>
                    </li>
                    <li>
                        <a class="side-menu__item {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}"
                            href="{{ url('/admin/dashboard') }}"><i class="side-menu__icon fe fe-users"></i><span
                                class="side-menu__label">User</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}"
                            href="{{ url('/admin/dashboard') }}"><i class="side-menu__icon fe fe-settings"></i><span
                                class="side-menu__label">Pengaturan</span></a>
                    </li>
                @endcan
                @can('member')
                @endcan
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg></div>
        </div>
    </div>
</div>