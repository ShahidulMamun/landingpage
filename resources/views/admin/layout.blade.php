<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Admin Panel') — ShopKori</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
  :root{ --admin-teal:#0F5257; }
  body{ background:#F4F6F7; font-family: 'Segoe UI', sans-serif; }
  .admin-sidebar{
    width:230px; min-height:100vh; background: var(--admin-teal);
    position:fixed; top:0; left:0; padding: 1.5rem 1rem;
    display:flex; flex-direction:column;
  }
  .admin-sidebar a{
    display:flex; align-items:center; gap:.6rem;
    color: rgba(255,255,255,0.8); padding:.6rem .8rem;
    border-radius:8px; text-decoration:none; font-size:.92rem; margin-bottom:.3rem;
  }
  .admin-sidebar a.active, .admin-sidebar a:hover{ background: rgba(255,255,255,0.12); color:#fff; }
  .admin-sidebar .brand{ color:#fff; font-weight:700; font-size:1.2rem; margin-bottom:1.5rem; display:block; }
  .admin-content{ margin-left:230px; padding: 2rem; }
  .admin-card{ background:#fff; border-radius:14px; padding:1.5rem; box-shadow:0 4px 16px rgba(0,0,0,0.04); }
  .btn-admin-primary{ background: var(--admin-teal); color:#fff; }
  .btn-admin-primary:hover{ background:#0A3A3E; color:#fff; }
  .admin-sidebar-footer{
    margin-top:auto; padding-top:1rem; border-top:1px solid rgba(255,255,255,0.15);
  }
  .admin-user{
    display:flex; align-items:center; gap:.5rem;
    color:#fff; font-size:.85rem; padding:.4rem .8rem; margin-bottom:.5rem;
  }
  .admin-user i{ font-size:1.1rem; }
  .admin-logout-btn{
    width:100%; display:flex; align-items:center; gap:.6rem;
    background:rgba(255,255,255,0.08); border:none; color:rgba(255,255,255,0.85);
    padding:.6rem .8rem; border-radius:8px; font-size:.9rem;
  }
  .admin-logout-btn:hover{ background:rgba(220,53,69,0.25); color:#fff; }
  @media (max-width: 767.98px){
    .admin-sidebar{ position:static; width:100%; min-height:auto; }
    .admin-content{ margin-left:0; padding:1.25rem; }
  }
</style>
@yield('extra_head')
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