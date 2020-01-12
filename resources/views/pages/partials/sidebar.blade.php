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
      <li class="nav-item dropdown {{ Request::is('product-manage') ? 'active' : '' }}">
        <a href="javascript;;" class="nav-link has-dropdown"><i class="fas fa-ticket-alt"></i><span>Products Management</span></a>
        <ul class="dropdown-menu">
          <li class="{{ Request::is('product-manage/vendors') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin::product-manage::vendor::home') }}">Vendors</a>
          </li>
          <li class="{{ Request::is('product-manage/categories') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin::product-manage::category::home') }}">Categories</a>
          </li>
          <li class="{{ Request::is('product-manage/brands') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin::product-manage::brand::home') }}">Brands</a>
          </li>
          <li class="{{ Request::is('product-manage/items') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin::product-manage::item::home') }}">Items</a>
          </li>
        </ul>
      </li>
      <li class="{{ Request::is('stock-manage') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin::stock-manage::stock::home') }}">
          <i class="fas fa-fire"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item dropdown {{ Request::is('customer-management') ? 'active' : '' }}">
        <a href="javascript;;" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>Customers Management</span></a>
        <ul class="dropdown-menu">
          <li class="Request::is('customer-management/customer') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin::customer-manage::customer::home') }}">Customers</a>
          </li>
        </ul>
      </li>
      <li class="nav-item dropdown {{ Request::is('user-management') ? 'active' : '' }}">
        <a href="javascript;;" class="nav-link has-dropdown"><i class="fas fa-user-alt"></i><span>Users Management</span></a>
        <ul class="dropdown-menu">
          <li class="Request::is('user-management/administrator') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin::user-manage::admin::home') }}">Administrators</a>
          </li>
          <li class="{{ Request::is('user-management/head-of-warehouse') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin::user-manage::head-of-warehouse::home') }}">Head of Warehouse</a>
          </li>
        </ul>
      </li>
    </ul>
  </aside>
</div>