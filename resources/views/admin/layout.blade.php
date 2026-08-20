<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Admin Panel') — ShopKori</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@yield('extra_head')
<link rel="stylesheet" href="{{asset('css/admin.layout.css')}}">
</head>
<body>

<div class="admin-sidebar">
  <a href="{{ route('admin.dashboard') }}" class="brand">Shop<span style="color:#FFC145">Kori</span> Admin</a>
  <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <i class="bi bi-speedometer2"></i> ড্যাশবোর্ড
  </a>
  <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
    <i class="bi bi-tags"></i> ক্যাটাগরি
  </a>
  <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
    <i class="bi bi-box-seam"></i> প্রোডাক্ট
  </a>
  <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
    <i class="bi bi-receipt"></i> অর্ডার
  </a>
  <a href="{{ route('admin.faqs.index') }}" class="{{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
    <i class="bi bi-question-circle"></i> FAQ
  </a>
  <a href="{{ route('landing') }}" target="_blank">
    <i class="bi bi-box-arrow-up-right"></i> সাইট দেখুন
  </a>

  <div class="admin-sidebar-footer">
    <div class="admin-user">
      <i class="bi bi-person-circle"></i>
      <span>{{ auth('admin')->user()->name ?? '' }}</span>
    </div>
    <form action="{{ route('admin.logout') }}" method="POST">
      @csrf
      <button type="submit" class="admin-logout-btn">
        <i class="bi bi-box-arrow-right"></i> লগআউট
      </button>
    </form>
  </div>
</div>

<div class="admin-content">
  @if(session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif
  @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>