<div class="sidebar bg-white border-end d-flex flex-column h-100">
    <div>
        {{-- HEADER --}}
        <div class="sidebar-header px-3 py-4">
            <h5 class="fw-semibold mb-0">Request System</h5>
            <small class="text-muted">Form Request</small>
        </div>

        {{-- USER INFO --}}
        <div class="px-3 pb-3 border-bottom">
            <small class="text-muted d-block mb-1">Logged in as</small>
            <div class="fw-semibold">
                {{ auth()->user()->name }}
            </div>
        </div>

        <ul class="nav flex-column px-2 mt-3">

            {{-- FORM REQUEST --}}
            <li class="nav-item mb-1">
                <small class="text-muted px-2 text-uppercase">
                    Form Request
                </small>
            </li>

            <li class="nav-item">
                <a href="{{ route('form.create') }}"
                    class="nav-link d-flex align-items-center gap-2
           {{ request()->routeIs('form.create') ? 'active' : '' }}">
                    <i class="fa-solid fa-plus"></i>
                    Add Form Request
                </a>
            </li>

            <li class="nav-item mb-3">
                <a href="{{ route('form.list') }}"
                    class="nav-link d-flex align-items-center gap-2
           {{ request()->routeIs('form.list') ? 'active' : '' }}">
                    <i class="fa-solid fa-list"></i>
                    List Form Request
                </a>
            </li>

            {{-- TCODE REQUEST --}}
            <li class="nav-item mb-1">
                <small class="text-muted px-2 text-uppercase">
                    TCode Request
                </small>
            </li>

            <li class="nav-item">
                <a href="{{ route('form.tcode.create') }}"
                    class="nav-link d-flex align-items-center gap-2
           {{ request()->routeIs('form.tcode.create') ? 'active' : '' }}">
                    <i class="fa-solid fa-plus"></i>
                    Add TCode Request
                </a>
            </li>

            <li class="nav-item mb-3">
                <a href="{{ route('form.tcode.list') }}"
                    class="nav-link d-flex align-items-center gap-2
           {{ request()->routeIs('form.tcode.list') ? 'active' : '' }}">
                    <i class="fa-solid fa-list"></i>
                    List TCode Request
                </a>
            </li>

            {{-- ADMIN --}}
            @if (auth()->user()->role === 'admin')
                <li class="nav-item">
                    <small class="text-muted px-2 text-uppercase">
                        Admin
                    </small>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.users') }}"
                        class="nav-link d-flex align-items-center gap-2
               {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                        <i class="fa-solid fa-users-gear"></i>
                        User Management
                    </a>
                </li>
            @endif

        </ul>


    </div>

    {{-- LOGOUT --}}
    <div class="mt-auto px-3 pb-3">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-2">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </button>
        </form>
    </div>
</div>
