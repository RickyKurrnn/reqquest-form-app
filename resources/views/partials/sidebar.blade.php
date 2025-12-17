<div class="sidebar bg-white border-end">
    <div class="sidebar-header px-3 py-4">
        <h5 class="fw-semibold mb-0">Request System</h5>
        <small class="text-muted">Form Request</small>
    </div>

    <ul class="nav flex-column px-2 mt-3">

        <li class="nav-item">
            <a href="{{ route('form.create') }}"
                class="nav-link d-flex align-items-center gap-2
               {{ request()->routeIs('form.create') ? 'active' : '' }}">
                <i class="fa-solid fa-plus"></i>
                Add New Request
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('form.list') }}"
                class="nav-link d-flex align-items-center gap-2
               {{ request()->routeIs('form.list') ? 'active' : '' }}">
                <i class="fa-solid fa-list"></i>
                List Form Request
            </a>
        </li>

    </ul>
</div>
