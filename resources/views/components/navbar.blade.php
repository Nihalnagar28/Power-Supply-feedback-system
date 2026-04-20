{{-- Navbar Component --}}
<nav class="navbar">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand">
            <span class="brand-icon">⚡</span>
            Power Supply
        </a>

        <button class="navbar-toggle" aria-label="Toggle navigation" aria-expanded="false">&#9776;</button>

        <ul class="navbar-nav">
            <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ url('/submit') }}" class="{{ request()->is('submit') ? 'active' : '' }}">Submit Feedback</a></li>
            <li><a href="{{ url('/complaints') }}" class="{{ request()->is('complaints') ? 'active' : '' }}">Complaints</a></li>
            @if(session('admin_logged_in'))
                <li><a href="{{ url('/admin/dashboard') }}" class="{{ request()->is('admin*') ? 'active' : '' }}">Dashboard</a></li>
                <li><a href="{{ url('/admin/logout') }}">Logout</a></li>
            @else
                <li><a href="{{ url('/admin') }}" class="{{ request()->is('admin') ? 'active' : '' }}">Admin</a></li>
            @endif
        </ul>
    </div>
</nav>
