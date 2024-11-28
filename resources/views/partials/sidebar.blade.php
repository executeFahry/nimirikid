<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}" class="brand-link">
            <img src="{{ asset('dist/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">Nimirikid</span>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="{{ route('dashboard') }}" class="nav-link active">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @if (auth()->user()->isAdmin())
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-database"></i>
                            <p>
                                Master Data
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('pelanggan.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-people-fill"></i>
                                    <p>Pelanggan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('kurir.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-truck"></i>
                                    <p>Kurir</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('paket.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-box-fill"></i>
                                    <p>Paket</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('status-pengiriman.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-info-circle-fill"></i>
                                    <p>Status Pengiriman</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @elseif(auth()->user()->isKurir())
                    <li class="nav-item">
                        <a href="{{ route('paket.kurir') }}" class="nav-link">
                            <i class="nav-icon bi bi-box"></i>
                            <p>Paket Saya</p>
                        </a>
                    </li>
                    {{-- @elseif(auth()->user()->isPelanggan())
                    <li class="nav-item">
                        <a href="{{ route('paket.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-box"></i>
                            <p>Paket Saya</p>
                        </a>
                    </li> --}}
                @endif
            </ul>
        </nav>
    </div>
</aside>
