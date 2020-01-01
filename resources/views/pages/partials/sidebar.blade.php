@php
  $route = Route::current()->uri;
@endphp
<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ route('admin::home') }}">Stisla</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">St</a>
    </div>
    <ul class="sidebar-menu">
      <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin::home') }}">
          <i class="fas fa-fire"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item dropdown {{ Request::is('user-management') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-alt"></i><span>User Management</span></a>
        <ul class="dropdown-menu">
          <li class="{{ Request::is('user-management/administrator') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin::user-manage::admin::home') }}">Administrator</a>
          </li>
          <li class="{{ Request::is('user-management/head-of-warehouse') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin::user-manage::head-of-warehouse::home') }}">Head of Warehouse</a></li>
        </ul>
      </li>
  </aside>
</div>