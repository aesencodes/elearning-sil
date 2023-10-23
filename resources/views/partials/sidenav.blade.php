<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            @if(Auth::user()->role_id == 199300)
            <a class="nav-link" href="{{ route('teacher.dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            @endif
            @if (Auth::User()->role_id == 999999) <!-- ADMIN -->
                <div class="sb-sidenav-menu-heading">User Management</div>
                <a class="nav-link" href="{{ route('admin.teacher') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chalkboard-user"></i></div>
                    Teachers
                </a>
                <a class="nav-link" href="{{ route('admin.student') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-children"></i></div>
                    Students
                </a>
            @endif

            {{-- Teacher Access --}}
            @if(Auth::user()->role_id == 199300)
                <div class="sb-sidenav-menu-heading">Kelas Management</div>
                <a class="nav-link" href="{{ route('teacher.create.class') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chalkboard-user"></i></div>
                    Buat Kelas
                </a><a class="nav-link" href="{{ route('teacher.class') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chalkboard-user"></i></div>
                    Daftar Kelas
                </a>
            @endif
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        @if (Auth::User()->role_id == 199300)
        {{ Auth::User()->guru->name }}
        @elseif(Auth::User()->role_id == 199200)
        {{ Auth::User()->siswa->name }}
        @elseif(Auth::User()->role_id == 999999)
        <p>admin nih bos</p>
        @endif
    </div>
</nav>
