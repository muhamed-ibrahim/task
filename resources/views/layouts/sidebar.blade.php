@php
    use App\Constants\RoleConstants;
    use App\Constants\UserConstants;
    use App\Constants\PermissionConstants;
@endphp
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard') ? '' : 'collapsed' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @if (auth()->user()->is_admin)
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('users.*') ? '' : 'collapsed' }}"
                    href="{{ route('users.index') }}">
                    <i class="bi bi-person"></i>
                    <span>User</span>
                </a>
            </li>
        @endif

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('posts.index', 'posts.show', 'posts.show', 'posts.create') ? '' : 'collapsed' }}"
                href="{{ route('posts.index') }}">
                <i class="bi bi-pencil-square"></i>
                <span>Post</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('posts.me', 'posts.edit', 'posts.destroy') ? '' : 'collapsed' }}"
                href="{{ route('posts.me') }}">
                <i class="bi bi-journal-text"></i>
                <span>My Posts</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('logout') ? '' : 'collapsed' }}" href="{{ route('logout') }}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>
        </li>

    </ul>

</aside><!-- End Sidebar -->
